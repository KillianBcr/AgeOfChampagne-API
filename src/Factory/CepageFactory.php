<?php

namespace App\Factory;

use App\Entity\Cepage;
use App\Repository\CepageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Cepage>
 *
 * @method        Cepage|Proxy create(array|callable $attributes = [])
 * @method static Cepage|Proxy createOne(array $attributes = [])
 * @method static Cepage|Proxy find(object|array|mixed $criteria)
 * @method static Cepage|Proxy findOrCreate(array $attributes)
 * @method static Cepage|Proxy first(string $sortedField = 'id')
 * @method static Cepage|Proxy last(string $sortedField = 'id')
 * @method static Cepage|Proxy random(array $attributes = [])
 * @method static Cepage|Proxy randomOrCreate(array $attributes = [])
 * @method static CepageRepository|RepositoryProxy repository()
 * @method static Cepage[]|Proxy[] all()
 * @method static Cepage[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Cepage[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Cepage[]|Proxy[] findBy(array $attributes)
 * @method static Cepage[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Cepage[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CepageFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Cepage $cepage): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Cepage::class;
    }
}
