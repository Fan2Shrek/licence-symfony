<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Faker\Factory;

class LanguageFixture extends AbstractFixture
{
    private static int $count = 0;

    public function getClass(): string
    {
        return Language::class;
    }

    public function getData(): iterable
    {
        yield ['name' => 'PHP'];
        yield ['name' => 'JS'];
        yield ['name' => 'Python'];
        yield ['name' => 'Scratch'];
        yield ['name' => 'Assembly'];
        yield ['name' => 'C'];
        yield ['name' => 'Binary'];
    }

    public function afterInstanciate(object $object): object
    {
        ++static::$count;
        $this->addReference('lang-' . static::$count, $object);

        return parent::afterInstanciate($object);
    }

    public static function getCount(): int
    {
        return static::$count;
    }
}
