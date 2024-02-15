<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class ProjectFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function getClass(): string
    {
        return Project::class;
    }

    public function getData(): iterable
    {
        $faker = Factory::create();

        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(0, CategoryFixture::getCount())),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(0, CategoryFixture::getCount())),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(0, CategoryFixture::getCount())),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(0, CategoryFixture::getCount())),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(0, CategoryFixture::getCount())),
        ];
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class
        ];
    }
}
