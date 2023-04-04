<?php

namespace App\DataFixtures;

use App\Entity\Cepage;
use App\Factory\CepageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CepageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cepage = file_get_contents(__DIR__ . '/data/Cepage.json',true);
        $cepages = json_decode($cepage,true);
        foreach($cepages as $elmt)
        {
            CepageFactory::createOne($elmt);
        }
    }

}
