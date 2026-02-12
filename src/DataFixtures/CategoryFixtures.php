<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'All about technology, gadgets, and software development'
            ],
            [
                'name' => 'Lifestyle',
                'description' => 'Tips and insights about life, health, and well-being'
            ],
            [
                'name' => 'Travel',
                'description' => 'Travel guides, tips, and destination reviews'
            ],
            [
                'name' => 'Food',
                'description' => 'Recipes, restaurant reviews, and culinary adventures'
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports news, analysis, and commentary'
            ],
        ];

        foreach ($categories as $index => $categoryData) {
            $category = new Category();
            $category->setName($categoryData['name']);
            $category->setDescription($categoryData['description']);
            $manager->persist($category);
            $this->addReference("category-$index", $category);
        }

        $manager->flush();
    }
}
