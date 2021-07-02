<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return[CategoryFixtures::class];
    }


    public function load(ObjectManager $manager)
    {
    
        for($i = 0; $i < 100; $i++){
            $post = new Post();
            $post
                ->setTitle("Post $i")
                ->setContent("content blabla");

            $category = $this->getReference("category_" . rand(0,4));
            $post->addCategory($category);

            $manager->persist($post);
        }
        $manager->flush();
    }
}
