<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class UserGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'email' => 'string',
            'nom' => 'string',
            'prenom' => 'string',
        ];
    }

    public function anonymousUserGetSimpleUserElement(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'email' => 'user1@example.com',
            'nom' => 'firstname1',
            'prenom' => 'lastname1',
        ];
        UserFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetSimpleUserElementForOthers(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'email' => 'user1@example.com',
            'nom' => 'firstname1',
            'prenom' => 'lastname1',
        ];
        /** @var $user User */
        $user = UserFactory::createOne()->object();
        UserFactory::createOne($data);
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendGet('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/2');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
