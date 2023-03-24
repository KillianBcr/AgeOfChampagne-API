<?php

namespace App\Factory;

use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Partenaire>
 *
 * @method        Partenaire|Proxy create(array|callable $attributes = [])
 * @method static Partenaire|Proxy createOne(array $attributes = [])
 * @method static Partenaire|Proxy find(object|array|mixed $criteria)
 * @method static Partenaire|Proxy findOrCreate(array $attributes)
 * @method static Partenaire|Proxy first(string $sortedField = 'id')
 * @method static Partenaire|Proxy last(string $sortedField = 'id')
 * @method static Partenaire|Proxy random(array $attributes = [])
 * @method static Partenaire|Proxy randomOrCreate(array $attributes = [])
 * @method static PartenaireRepository|RepositoryProxy repository()
 * @method static Partenaire[]|Proxy[] all()
 * @method static Partenaire[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Partenaire[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Partenaire[]|Proxy[] findBy(array $attributes)
 * @method static Partenaire[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Partenaire[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PartenaireFactory extends ModelFactory
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
        $domain = self::faker()->domainName();

        return [
            'description' => self::faker()->sentence(10),
            'email' => self::faker()->unique()->numerify('####@'.$domain),
            'nom' => self::faker()->firstName(),
            'telephone' => self::faker()->unique()->phoneNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Partenaire $partenaire): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Partenaire::class;
    }
}
