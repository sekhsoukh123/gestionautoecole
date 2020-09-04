<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Candidat;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $candidat = new Product();
        // $manager->persist($candidat);

     //    // create 20 products! Bam!
     // for ($i = 0; $i < 20; $i++) {
     //      $candidat = new Candidat();
     //      $candidat->setFirstName('candidat '.$i);
     //      $candidat->setLastName('candidat '.$i);
     //      $candidat->setLieuNaissance('lieu '.$i);
     //      $candidat->setPaysNaissance('pays '.$i);
     //      $candidat->setDateNaissance(new \DateTime());
     //      $candidat->setTelephone1('03333333 ');
     //      $candidat->setCreated(new \DateTime());
     //      $candidat->setUpdated(new \DateTime());
     //
     //      $manager->persist($candidat);
     // }
     //
     //    $manager->flush();
    }
}
