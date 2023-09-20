<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class EtudiantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // creer objet faker
        $faker = Factory::create("fr_FR");
        // creer 100 etudiants
        for ($i = 1; $i <= 5000; $i++) {
            $etudiant = new Etudiant();
            $etudiant->setPrenom($faker->firstName());
            $etudiant->setNom($faker->lastName());
            $etudiant->setEmail($faker->freeEmail());
            $etudiant->setDateNaissance($faker->dateTimeInInterval("-17 years", "-17 years"));
            $etudiant->setPromotion($this->getReference("promotion_".$faker->numberBetween(0,9)));
            // persister l'etudiant
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [PromotionFixtures::class];
    }
}
