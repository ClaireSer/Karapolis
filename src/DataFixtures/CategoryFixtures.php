<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    CONST PINGPONG_CATEGORY_REFERENCE = "PINGPONG_CATEGORY_REFERENCE";
    CONST SPORT_CATEGORY_REFERENCE = "SPORT_CATEGORY_REFERENCE";

    public function load(ObjectManager $manager): void
    {
        $parentCategory1 = new Category();
        $parentCategory1->setName("Sport");
        $manager->persist($parentCategory1);
        $this->addReference(self::SPORT_CATEGORY_REFERENCE, $parentCategory1);

        $parentCategory2 = new Category();
        $parentCategory2->setName("Art");
        $manager->persist($parentCategory2);

        $childCategory1 = new Category();
        $childCategory1
            ->setName("Yoga")
            ->setParent($parentCategory1)
        ;
        $manager->persist($childCategory1);

        $childCategory2 = new Category();
        $childCategory2
            ->setName("Ping Pong")
            ->setParent($parentCategory1)
        ;
        $manager->persist($childCategory2);
        $this->addReference(self::PINGPONG_CATEGORY_REFERENCE, $childCategory2);

        $childCategory3 = new Category();
        $childCategory3
            ->setName("Karaoké")
            ->setParent($parentCategory2)
        ;
        $manager->persist($childCategory3);

        $manager->flush();
    }
}
