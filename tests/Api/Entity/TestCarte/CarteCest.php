<?php

namespace App\Tests\Api\Entity\TestCarte;

use App\Factory\CarteFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class CarteCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'description' => 'string',
            'createdAt' => 'date',
            'public' => 'bool',
        ];
    }

    public function anonymousUserCannotAccessCards(ApiTester $I): void
    {
        // 1. 'Act'
        $I->sendGet('/api/cards');

        // 2. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserCanAccessCards(ApiTester $I): void
    {
        // 1. 'Arrange'
        UserFactory::createOne();
        $user = UserFactory::createOne()->object();
        CarteFactory::createMany(5, ['creator' => $user]);

        // 2. 'Act'
        $I->amLoggedInAs($user);
        $I->sendGet('/api/carte');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'hydra:totalItems' => 5,
        ]);
        $I->seeResponseMatchesJsonType([
            '@context' => 'string',
            '@id' => 'string',
            '@type' => 'string',
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
    }

    public function authenticatedUserCanCreateCard(ApiTester $I): void
    {
        // 1. 'Arrange'
        $user = UserFactory::createOne()->object();
        $payload = [
            'name' => 'Test Carte',
            'description' => 'Test Carte Description',
        ];

        // 2. 'Act'
        $I->amLoggedInAs($user);
        $I->sendPost('/api/carte', $payload);

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(self::expectedProperties());
        $I->seeResponseContainsJson([
            'name' => $payload['name'],
            'description' => $payload['description'],
        ]);
    }

    public function authenticatedUserCannotCreateCardWithoutTitle(ApiTester $I): void
    {
        // 1. 'Arrange'
        $user = UserFactory::createOne()->object();
        $payload = [
            'description' => 'Test Card Description',
        ];
        // 2. 'Act'
        $I->amLoggedInAs($user);
        $I->sendPost('/api/cards', $payload);

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'message' => 'title: This value should not be blank.',
            'detail' => 'Invalid input.',
            'type' => 'https://tools.ietf.org/html/rfc2616#section-10',
        ]);
    }
}
