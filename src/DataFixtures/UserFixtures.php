<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private Generator $faker;

    // Constructeur
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName($this->faker->name);
            $user->setRoles(['ROLE_USER']);
            $user->setEmail($this->faker->email());
            $user->setPassword($this->hasher->hashPassword($user, $this->faker->password(8)));  // Mot de passe hashé
            $manager->persist($user);
        }
        $manager->flush();
    }
}
