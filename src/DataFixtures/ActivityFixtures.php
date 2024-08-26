<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    CONST PINGPONG_REFERENCE = "PINGPONG_REFERENCE";

    public function load(ObjectManager $manager): void
    {
        $activity = new Activity();
        $activity
            ->setName("Tournante de Ping Pong")
            ->setDescription("Venez nombreux !")
            ->setMeetingDate(new DateTime("2024/09/15"))
            ->setLocation("Lausanne")
            ->setAuthor($this->getReference(UserFixtures::AUTHOR_REFERENCE))
            ->addParticipant($this->getReference(UserFixtures::PARTICIPANT_REFERENCE))
        ;
        $this->addReference(self::PINGPONG_REFERENCE, $activity);

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
