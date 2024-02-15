<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;

class CategoryFixture extends AbstractFixture
{
    private static int $count = 0;

    public function getData(): iterable
    {
        $faker = Factory::create();

        yield ['name' => $faker->word()];
        yield ['name' => $faker->word()];
        yield ['name' => $faker->word()];
    }

    public function getClass(): string
    {
        return Category::class;
    }

    public function afterInstanciate(object $object): object
    {
        $this->addReference('cat-' . static::$count, $object);
        ++static::$count;

        return parent::afterInstanciate($object);
    }

    public static function getCount(): int
    {
        return static::$count;
    }
}
