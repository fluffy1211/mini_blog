<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
final class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(
        Request $request,
        PostRepository $postRepository,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post created successfully!');
            return $this->redirectToRoute('app_admin');
        }

        $posts = $postRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'posts' => $posts,
            'form' => $form->createView(),
        ]);
    }
}
