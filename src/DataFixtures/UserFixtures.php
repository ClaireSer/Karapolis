<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    CONST PARTICIPANT_REFERENCE = "PARTICIPANT_REFERENCE";
    CONST AUTHOR_REFERENCE = "AUTHOR_REFERENCE";

    public function __construct(public UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $participant = new User();
        $participant
            ->setEmail("participant@hello.com")
            ->setPassword($this->userPasswordHasher->hashPassword($participant, "hello"))
            ->setGender("f")
        ;
        $manager->persist($participant);
        $this->addReference(self::PARTICIPANT_REFERENCE, $participant);

        $author = new User();
        $author
            ->setEmail("author@hello.com")
            ->setPassword($this->userPasswordHasher->hashPassword($author, "hello"))
            ->setGender("m")
        ;
        $manager->persist($author);
        $this->addReference(self::AUTHOR_REFERENCE, $author);

        $manager->flush();
    }
}
