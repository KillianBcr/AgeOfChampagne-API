<?php

namespace App\Tests\Api\Entity\TestCarte;

use App\Factory\CarteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class CartePutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'qrcode' => 'int',
            'description' => 'string',
            'image' => 'blob',
        ];
    }

    public function anonymousUserForbiddenToPutCarte(ApiTester $I): void
    {
        // 1. 'Arrange'
        CarteFactory::createOne();
        UserFactory::createOne();
        // 2. 'Act'
        $I->sendPut('/api/users/1');
        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
