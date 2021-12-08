<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
            
        for ($i = 1; $i <= 3; $i++)
        {
            $category = new Category();
    
            $category->setName($faker->name())
                    ->setDescription($faker->text(300));              
            $manager->persist($category);
        }
    
        $manager->flush();
    }
    
}
