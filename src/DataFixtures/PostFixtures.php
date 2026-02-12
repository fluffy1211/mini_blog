<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $posts = [
            ['title' => 'Getting Started with Symfony', 'content' => 'Symfony is a powerful PHP framework for web development.', 'userRef' => 'admin-user', 'categoryRef' => 'category-0'],
            ['title' => '10 Tips for Healthier Living', 'content' => 'Simple tips to improve your well-being and health.', 'userRef' => 'user-1', 'categoryRef' => 'category-1'],
            ['title' => 'Exploring the Mountains', 'content' => 'Discover breathtaking mountain scenery around the world.', 'userRef' => 'user-2', 'categoryRef' => 'category-2'],
            ['title' => 'Best Pasta Recipes', 'content' => 'Delicious pasta recipes for every taste.', 'userRef' => 'user-3', 'categoryRef' => 'category-3'],
            ['title' => 'Modern Web Development', 'content' => 'Essential skills and technologies for modern web developers.', 'userRef' => 'admin-user', 'categoryRef' => 'category-0'],
            ['title' => 'Champions League Preview', 'content' => 'Analysis and predictions for the upcoming final.', 'userRef' => 'user-4', 'categoryRef' => 'category-4'],
            ['title' => 'Mediterranean Diet Guide', 'content' => 'Health benefits and tips for Mediterranean eating.', 'userRef' => 'user-1', 'categoryRef' => 'category-3'],
            ['title' => 'Hidden Gems in Asia', 'content' => 'Discover amazing destinations off the beaten path.', 'userRef' => 'user-2', 'categoryRef' => 'category-2'],
        ];

        foreach ($posts as $index => $postData) {
            $post = new Post();
            $post->setTitle($postData['title']);
            $post->setContent($postData['content']);
            $post->setPublishedAt(new \DateTimeImmutable());
            $post->setUser($this->getReference($postData['userRef'], User::class));
            $post->setCategory($this->getReference($postData['categoryRef'], Category::class));
            $manager->persist($post);
            $this->addReference("post-$index", $post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
