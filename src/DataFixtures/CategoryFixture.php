<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;

class CategoryFixture extends AbstractFixture
{
    private static int $count = 0;

    public function getData(): iterable
    {
        yield ['name' => "Projet personnel"];
        yield ['name' => "E-Commerce"];
        yield ['name' => "Application mobile"];
        yield ['name' => "Veille technologique"];
    }

    public function getClass(): string
    {
        return Category::class;
    }

    public function afterInstanciate(object $object): object
    {
        ++static::$count;
        $this->addReference('cat-' . static::$count, $object);

        return parent::afterInstanciate($object);
    }

    public static function getCount(): int
    {
        return static::$count;
    }
}
