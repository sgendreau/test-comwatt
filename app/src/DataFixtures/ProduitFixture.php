<?php

namespace App\DataFixtures;

use App\Entity\Pays;
use App\Entity\Produit;
use App\Entity\RefTypeGenre;
use App\Entity\RefTypeProduit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ProduitFixture extends Fixture
{
    public function load(ObjectManager $objectManager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $genres = $objectManager->getRepository(RefTypeGenre::class)->findAll();
        $types = $objectManager->getRepository(RefTypeProduit::class)->findAll();
        $pays = $objectManager->getRepository(Pays::class)->findAll();
        /** @var Pays $france */
        $france = $objectManager->getRepository(Pays::class)->findOneBy(['alpha3' => 'FRA']);

        for($i = 0; $i < 20; $i++) {
            $produit = new Produit();
            $produit->setNote(rand(0, 10));
            $produit->setPrix(rand(10, 100)/5);
            $produit->setAnneeEdition(rand(1666, 2021));
            $produit->setTitre(implode(' ', $faker->words(rand(2, 6))));
            if($i % 4 == 0) {
                $produit->setNationalite($france);
            } else {
                $produit->setNationalite($pays[rand(0, count($pays)-1)]);
            }
            if($produit->getNationalite()->getAlpha3() !== 'FRA') {
                $produit->setTitreOriginal(implode(' ', $faker->words(rand(2, 6))));
            }
            $produit->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non nunc ut neque facilisis laoreet. Mauris nulla leo, ultricies vel euismod eget, pulvinar nec risus. Nam cursus suscipit augue in dignissim. Nunc fermentum mi sit amet vestibulum laoreet. Proin feugiat ex eu nisi porttitor aliquam. Sed sapien nunc, iaculis sit amet odio non, lobortis blandit nisl. Donec id arcu at sem aliquet aliquet eget feugiat eros. Curabitur et enim et quam lacinia porta vitae ut augue. Nunc aliquet, turpis nec pulvinar consectetur, libero sem aliquam nunc, sit amet interdum dui nunc ut nunc.');
            $produit->addGenre($genres[rand(0, count($genres)-1)]);
            $produit->setTypeProduit($types[rand(0, count($types)-1)]);

            $objectManager->persist($produit);
        }
        $objectManager->flush();
    }
}