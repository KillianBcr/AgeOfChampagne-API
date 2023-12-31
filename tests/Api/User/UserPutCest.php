<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserPutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nom' => 'string',
            'prenom' => 'string',
            'telephone' => 'string',
            'cp' => 'string',
            'ville' => 'string',
            'email' => 'string:email',
        ];
    }

    public function anonymousUserForbiddenToPutUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        UserFactory::createOne();

        // 2. 'Act'
        $I->sendPut('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPutOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        /** @var $user User */
        $user = UserFactory::createOne()->object();
        UserFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPut('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticatedUserCanPutOwnData(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'nom' => 'lastname1',
            'prenom' => 'firstname1',
            'email' => 'login1@example.com',
        ];
        /** @var $user User */
        $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            'nom' => 'lastname2',
            'prenom' => 'firstname2',
            'email' => 'login2@example.com',
        ];
        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPut);
    }

    public function authenticatedUserCanChangeHisPassword(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'email' => 'login1@example.com',
            'password' => 'password',
        ];
        /** @var $user User */
        $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = ['password' => 'new password'];
        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties());

        // 2. 'Act'
        $I->amOnPage('/logout');
        // Don't check response code since homepage is not configured (404)
        // $I->seeResponseCodeIsSuccessful();
        $I->amOnPage('/login');
        $I->seeResponseCodeIsSuccessful();
        $I->submitForm(
            'form',
            ['email' => 'login1@example.com', 'password' => 'new password'],
            'Authentification'
        );

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeInCurrentUrl('/login');
    }
}
