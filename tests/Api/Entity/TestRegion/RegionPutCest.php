<?php

namespace App\Tests\Api\Entity\TestRegion;

use App\Entity\User;
use App\Factory\RegionFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class RegionPutCest
{
        public function testCreateRegion(): void
    {
        $region = new Region();

        $this->assertInstanceOf(Region::class, $region);
    }

    public function testGetId(): void
    {
        $region = new Region();
        $region->setId(1);

        $this->assertSame(1, $region->getId());
    }

}