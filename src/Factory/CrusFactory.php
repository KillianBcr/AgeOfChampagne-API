<?php

namespace App\Factory;

use App\Entity\Crus;
use App\Repository\CepageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Crus>
 *
 * @method        Crus|Proxy create(array|callable $attributes = [])
 * @method static Crus|Proxy createOne(array $attributes = [])
 * @method static Crus|Proxy find(object|array|mixed $criteria)
 * @method static Crus|Proxy findOrCreate(array $attributes)
 * @method static Crus|Proxy first(string $sortedField = 'id')
 * @method static Crus|Proxy last(string $sortedField = 'id')
 * @method static Crus|Proxy random(array $attributes = [])
 * @method static Crus|Proxy randomOrCreate(array $attributes = [])
 * @method static CepageRepository|RepositoryProxy repository()
 * @method static Crus[]|Proxy[] all()
 * @method static Crus[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Crus[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Crus[]|Proxy[] findBy(array $attributes)
 * @method static Crus[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Crus[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CrusFactory extends ModelFactory
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
            'cepage' => CepageFactory::new(),
            'description' => self::faker()->text(255),
            'nom' => self::faker()->text(30),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Crus $crus): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Crus::class;
    }
}
