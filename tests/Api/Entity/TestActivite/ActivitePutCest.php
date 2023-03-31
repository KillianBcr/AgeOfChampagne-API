<?php

namespace App\Tests\Api\Entity\TestActivite;

use App\Entity\Activite;
use App\Factory\ActiviteFactory;
use App\Tests\Support\ApiTester;

class ActivitePutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nom' => 'string',
            'description' => 'string',
            'icon' => 'string',
        ];
    }

    public function getActivite(ApiTester $I): void
    {
        $dataInit = [
            'nom' => 'test',
            'description' => 'coucou',
            'icon' => 'azertyuiop',
        ];

        $activite = ActiviteFactory::createOne($dataInit)->object();
        $I->sendGet('/api/activites/1');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Activite::class, '/api/activites/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), (array) $activite);
    }
}
