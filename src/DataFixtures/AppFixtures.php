<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $demoClient = new Client();
        $demoClient
            ->setEmail('demo@demo.fr')
            ->setPassword($this->hasher->hashPassword($demoClient, 'demo'));

        $manager->persist($demoClient);
        $manager->flush();
    }
}
