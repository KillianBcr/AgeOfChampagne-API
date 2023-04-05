<?php

namespace App\Tests\Api\Entity\TestCarte;

use App\Factory\CarteFactory;
use App\Tests\Support\ApiTester;

class CarteGetImageCest
{
    public function getImage(ApiTester $I): void
    {
        // 1. 'Arrange'
        $user = CarteFactory::createOne();

        // 2. 'Act'
        $I->sendGet('/api/users/1/avatar');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeHttpHeader('Content-Type', 'image/png');
        $I->seeResponseContains(stream_get_contents($user->getAvatar(), -1, 0));
    }
}
