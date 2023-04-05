<?php

namespace App\DataFixtures;

use App\Factory\CarteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\File;

class CarteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $carte = file_get_contents(__DIR__.'/data/Cartes.json', true);
        $cartes = json_decode($carte, true);

        foreach ($cartes as $elmt) {
            $carte = CarteFactory::createOne([
                'name' => $elmt['name'],
                'description' => $elmt['description'],
                'qrCode' => $elmt['qrCode'],
                'image' => new File($elmt['image']),
                'public' => $elmt['public'],
            ]);
        }
    }
}
