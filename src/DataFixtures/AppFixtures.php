<?php

namespace App\DataFixtures;

use App\Entity\Ouvrage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;                          // On utilise faker pour générer des valeurs aléatoires réalistes
use Faker\Generator;

class AppFixtures extends Fixture
{
    // Constantes
    private const categories = [
        'Roman',
        'Science-fiction',
        'Fantasy',
        'Policier',
        'Biographie',
        'Essai',
        'Poésie',
        'Histoire',
        'Jeunesse',
        'Thriller'
    ];

    private const editeur = [
        'Éditions du Lys Bleu',
        'Horizons Littéraires',
        'Maison des Mots',
        'Éditions Clair de Lune',
        'La Bibliothèque Imaginaire',
        'Éditions du Vent du Nord',
        'Nouvelles Pages',
        'Éditions Scriptorium',
        'Le Phare Éditorial',
        'Les Ateliers du Livre',
        'Éditions Arc-en-Ciel',
        'La Forge des Lettres',
        'Éditions du Rêve Éveillé',
    ];

    private const langue = [
        'Français',
        'Anglais',
        'Espagnol',
        'Allemand',
        'Italien',
        'Portugais',
        'Néerlandais',
        'Polonais',
        'Russe',
        'Chinois',
        'Japonais',
        'Coréen',
        'Arabe'
    ];

    private Generator $faker;

    // Constructeur
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $ouvrage = new Ouvrage;
        for ($i = 0; $i < 20; $i++) {
            $product = new Ouvrage();
            $product->setTitre($this->faker->sentence(3));
            $product->setAuteurs($this->faker->name);
            $product->setCatégories($this->faker->randomElement(self::categories));
            $product->setAnnée($this->faker->year);
            $product->setTags('');
            $product->setIsbnIssn($this->faker->numerify('#############'));
            $product->setLangues($this->faker->randomElement(self::langue, $this->faker->numberBetween(2, 12)));
            $product->setéditeur($this->faker->randomElement(self::editeur));
            $product->setRésumé($this->faker->realText(200));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
