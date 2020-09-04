<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CandidatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      // create 20 products! Bam!
   // for ($i = 0; $i < 20; $i++) {
   //      $candidat = new Candidat();
   //      $candidat->setFirstName('candidat '.$i);
   //      $candidat->setLastName('candidat '.$i);
   //      $candidat->setLieuNaissance('lieu '.$i);
   //      $candidat->setPaysNaissance('pays '.$i);
   //      $candidat->setDateNaissance(new \DateTime());
   //      $candidat->setTelephone1('0333333333');
   //      $candidat->setCreated(new \DateTime());
   //      $candidat->setUpdated(new \DateTime());

        // $manager->persist($candidat);
   }

      $manager->flush();
    }
}
