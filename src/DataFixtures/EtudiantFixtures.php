<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // creer objet faker
        $faker = Factory::create("fr_FR");
        // creer 100 etudiants
        for ($i = 1; $i <= 100000; $i++) {
            $etudiant = new Etudiant();
            $etudiant->setPrenom($faker->firstName());
            $etudiant->setNom($faker->lastName());
            $etudiant->setEmail($faker->freeEmail());
            $etudiant->setDateNaissance($faker->dateTimeInInterval("-17 years", "-17 years"));
            // persister l'etudiant
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
