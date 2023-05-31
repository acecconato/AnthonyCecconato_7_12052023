<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Ulid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $demoClient = new Client();
        $demoClient
            ->setEmail('demo@demo.fr')
            ->setPassword(new Ulid());

        $manager->persist($demoClient);
        $manager->flush();
    }
}
