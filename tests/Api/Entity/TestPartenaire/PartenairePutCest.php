<?php

namespace App\Tests\Api\Entity\TestPartenaire;

use App\Entity\Partenaire;
use App\Factory\PartenaireFactory;
use App\Factory\UserFactory;
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
            'image' => 'blob',
        ];
    }

    public function anonymousUserForbiddenToPutPartenaire(ApiTester $I): void
    {
        // 1. 'Arrange'
        PartenaireFactory::createOne();
        UserFactory::createOne();
        // 2. 'Act'
        $I->sendPut('/api/users/1');
        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPutOtherPartenaire(ApiTester $I): void
    {
        // 1. 'Arrange'
        /** @var $user Partenaire */
        $user = UserFactory::createOne()->object();
        PartenaireFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPut('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
