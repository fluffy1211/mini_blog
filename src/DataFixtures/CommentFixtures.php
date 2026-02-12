<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $comments = [
            [
                'content' => 'Great article! Very informative and well-written.',
                'postRef' => 'post-0',
                'userRef' => 'user-1',
                'status' => 'approved'
            ],
            [
                'content' => 'Thanks for sharing these tips. I\'ll definitely try them out!',
                'postRef' => 'post-1',
                'userRef' => 'user-2',
                'status' => 'approved'
            ],
            [
                'content' => 'I visited Switzerland last year and it was absolutely amazing!',
                'postRef' => 'post-2',
                'userRef' => 'user-3',
                'status' => 'approved'
            ],
            [
                'content' => 'Could you share the recipe for the carbonara? It looks delicious!',
                'postRef' => 'post-3',
                'userRef' => 'user-4',
                'status' => 'approved'
            ],
            [
                'content' => 'This is exactly what I needed to learn. Thank you!',
                'postRef' => 'post-4',
                'userRef' => 'user-1',
                'status' => 'approved'
            ],
            [
                'content' => 'Can\'t wait for the final! Who do you think will win?',
                'postRef' => 'post-5',
                'userRef' => 'user-2',
                'status' => 'approved'
            ],
            [
                'content' => 'I\'ve been following the Mediterranean diet for 6 months now and feel great!',
                'postRef' => 'post-6',
                'userRef' => 'user-3',
                'status' => 'approved'
            ],
            [
                'content' => 'Adding these destinations to my travel bucket list!',
                'postRef' => 'post-7',
                'userRef' => 'user-4',
                'status' => 'approved'
            ],
            [
                'content' => 'Could you write a follow-up article with more advanced topics?',
                'postRef' => 'post-0',
                'userRef' => 'user-2',
                'status' => 'approved'
            ],
            [
                'content' => 'Symfony has really improved my development workflow!',
                'postRef' => 'post-0',
                'userRef' => 'user-3',
                'status' => 'approved'
            ],
            [
                'content' => 'This comment is pending moderation.',
                'postRef' => 'post-1',
                'userRef' => 'user-4',
                'status' => 'pending'
            ],
            [
                'content' => 'The photos in this article are stunning!',
                'postRef' => 'post-2',
                'userRef' => 'user-1',
                'status' => 'approved'
            ],
        ];

        foreach ($comments as $commentData) {
            $comment = new Comment();
            $comment->setContent($commentData['content']);
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setStatus($commentData['status']);
            $comment->setPost($this->getReference($commentData['postRef'], Post::class));
            $comment->setUser($this->getReference($commentData['userRef'], User::class));
            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            PostFixtures::class,
        ];
    }
}
