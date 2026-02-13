<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
class ApiAuthController extends AbstractController
{
    #[Route('/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        JWTTokenManagerInterface $jwtManager,
        ValidatorInterface $validator,
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON body'], Response::HTTP_BAD_REQUEST);
        }

        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $firstName = $data['firstName'] ?? null;
        $lastName = $data['lastName'] ?? null;

        if (!$email || !$password || !$firstName || !$lastName) {
            return $this->json(
                ['error' => 'Missing required fields: email, password, firstName, lastName'],
                Response::HTTP_BAD_REQUEST,
            );
        }

        // Check if user already exists
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingUser) {
            return $this->json(['error' => 'A user with this email already exists'], Response::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setPassword($passwordHasher->hashPassword($user, $password));

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }

            return $this->json(['errors' => $errorMessages], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        $token = $jwtManager->create($user);

        return $this->json([
            'message' => 'User registered successfully',
            'token' => $token,
        ], Response::HTTP_CREATED);
    }
}
