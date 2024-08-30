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
        $activity1 = new Activity();
        $activity1
            ->setName("Tournante de Ping Pong")
            ->setDescription("Venez nombreux !")
            ->setMeetingDate(new DateTime("2024/09/15"))
            ->setLocation("Lausanne")
            ->addCategory($this->getReference(CategoryFixtures::PINGPONG_CATEGORY_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::SPORT_CATEGORY_REFERENCE))
            ->setAuthor($this->getReference(UserFixtures::AUTHOR_REFERENCE))
            ->addParticipant($this->getReference(UserFixtures::PARTICIPANT_REFERENCE))
        ;
        $manager->persist($activity1);

        $activity2 = new Activity();
        $activity2
            ->setName("Karaoké")
            ->setDescription("Soyez maitre chanteur !")
            ->setMeetingDate(new DateTime("2024/11/10"))
            ->setLocation("BARBEROUSSE Lausanne")
            ->addCategory($this->getReference(CategoryFixtures::ART_CATEGORY_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::KARAOKE_CATEGORY_REFERENCE))
            ->setAuthor($this->getReference(UserFixtures::AUTHOR_REFERENCE))
            ->addParticipant($this->getReference(UserFixtures::PARTICIPANT_REFERENCE))
        ;
        $manager->persist($activity2);

        $activity3 = new Activity();
        $activity3
            ->setName("Yoga à Vidy")
            ->setDescription("Zeeeeen !")
            ->setMeetingDate(new DateTime("2024/12/10"))
            ->setLocation("Vidy")
            ->addCategory($this->getReference(CategoryFixtures::SPORT_CATEGORY_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::YOGA_CATEGORY_REFERENCE))
            ->setAuthor($this->getReference(UserFixtures::AUTHOR_REFERENCE))
            ->addParticipant($this->getReference(UserFixtures::PARTICIPANT_REFERENCE))
        ;
        $manager->persist($activity3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
