<?php

namespace App\Tests\Api\Entity\TestPartenaire;

use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class PartenairePutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nom' => 'string',
            'email' => 'string:email',
            'telephone' => 'string',
            'description' => 'string',
            'image'=> 'blob',
        ];
    }

    public function anonymousUserForbiddenToPutUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        PartenaireFactory::createOne();

        // 2. 'Act'
        $I->sendPut('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }





}