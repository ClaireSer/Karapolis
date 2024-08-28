<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $activity = new Activity();
        $activity
            ->setName("Tournante de Ping Pong")
            ->setDescription("Venez nombreux !")
            ->setMeetingDate(new DateTime("2024/09/15"))
            ->setLocation("Lausanne")
            ->addCategory($this->getReference(CategoryFixtures::PINGPONG_CATEGORY_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::SPORT_CATEGORY_REFERENCE))
            ->setAuthor($this->getReference(UserFixtures::AUTHOR_REFERENCE))
            ->addParticipant($this->getReference(UserFixtures::PARTICIPANT_REFERENCE))
        ;
        $manager->persist($activity);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
