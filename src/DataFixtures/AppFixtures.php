<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        /** @var Client[] $clients */
        $clients = [];
        for ($i = 0; $i < 3; ++$i) {
            $client = new Client();
            $client
                ->setEmail("demo$i@demo.fr")
                ->setPassword($this->hasher->hashPassword($client, 'demo'));

            $manager->persist($client);
            $clients[] = $client;
        }

        for ($i = 0; $i < 50; ++$i) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setUsername($faker->userName())
                ->setcreatedAt(new \DateTimeImmutable());

            if (1 === rand(0, 1)) {
                $user->setUrl($faker->url());
            }

            $user->setClient($clients[rand(0, count($clients) - 1)]);

            $manager->persist($user);
        }

        for ($i = 0; $i < 50; ++$i) {
            $manager->persist(
                (new Product())
                    ->setName("Product n°$i")
                    ->setBrand($faker->company())
                    ->setModel("Model #$i")
                    ->setDescription($faker->text(1000))
                    ->setPrice($faker->randomFloat(2, 0, 1000))
            );
        }

        $manager->flush();
    }
}
