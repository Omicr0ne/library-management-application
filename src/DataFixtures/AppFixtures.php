<?php

namespace App\DataFixtures;

use App\Entity\Exemplaire;
use App\Entity\Ouvrage;
use DateTimeImmutable;
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

    private const etat = [
        'neuf',
        'bon',
        'mauvais'
    ];

    private Generator $faker;

    // Constructeur
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 40; $i++) {
            $cat = $this->faker->randomElement(self::categories);
            $aut = $this->faker->name;
            $ouvrage = new Ouvrage();
            $ouvrage->setTitre($this->faker->sentence(3));
            $ouvrage->setAuteurs($aut);
            $ouvrage->setCategories($cat);
            $ouvrage->setAnnee($this->faker->year);
            $ouvrage->setTags('');
            $ouvrage->setIsbnIssn($this->faker->numerify('#############'));
            $ouvrage->setLangues($this->faker->randomElement(self::langue));
            $ouvrage->setediteur($this->faker->randomElement(self::editeur));
            $ouvrage->setResume($this->faker->realText(200));
            $ouvrage->setCreatedAt(new DateTimeImmutable());
            $manager->persist($ouvrage);
            $manager->flush();

            $exemplaire = new Exemplaire();
            $exemplaire->setCote(mb_substr(mb_strtoupper($cat), 0, 3));
            $exemplaire->setDisponibilite(mt_rand(0, 1));
            $exemplaire->setEtat($this->faker->randomElement(self::etat));
            $exemplaire->setOuvrage($ouvrage);
            $exemplaire->setCreatedAt(new DateTimeImmutable());
            $manager->persist($exemplaire);
            $manager->flush();
        }
    }
}
