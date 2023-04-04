<?php

namespace App\DataFixtures;

use App\Entity\Crus;
use App\Factory\CrusFactory;
use App\Repository\CepageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrusFixtures extends Fixture
{
    public CepageRepository $repository;
    public function __construct(CepageRepository $repository)
    {
        $this->repository = $repository;
    }
    public function load(ObjectManager $manager): void
    {
        $cru= file_get_contents(__DIR__ . '/data/Crus.json',true);
        $crus = json_decode($cru,true);

        $crusRepository = $this->repository;

        foreach($crus as $elmt)
        {
            CrusFactory::createOne([
                'nom' => $elmt['nom'],
                'description' => $elmt['description'],
                'cepage' => $crusRepository->find($elmt['cepage'])
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            CepageFixtures::class,
        ];
    }
}
