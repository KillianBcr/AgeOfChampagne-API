<?php

namespace App\Tests\Api\Entity\TestPartenaire;

use App\Entity\User;
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

    /*public function authenticatedUserForbiddenToPutOtherPartenaire(ApiTester $I): void
    {
        $dataInit = [
            'nom' => 'nom1',
            'email' => 'login1',
            'telephone' => 'tel1',
        ];
        /** @var $user User */
       /* $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            'nom' => 'nom2',
            'email' => 'login2',
            'telephone' => 'tel2',
        ];
        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPut);
    }*/
}
