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
            'category' => $this->getReference('cat-' . rand(1, CategoryFixture::getCount())),
            'languages' => $this->randomLanguage(),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(1, CategoryFixture::getCount())),
            'languages' => $this->randomLanguage(),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(1, CategoryFixture::getCount())),
            'languages' => $this->randomLanguage(),
        ];
        yield [
            'name' => $faker->word(),
            'description' => $faker->text(),
            'link' => $faker->url(),
            'startedAt' => $faker->dateTime(),
            'category' => $this->getReference('cat-' . rand(1, CategoryFixture::getCount())),
            'languages' => $this->randomLanguage(),
        ];
    }

    public function afterInstanciate(object $object): object
    {
        $faker = Factory::create();

        $path = $faker->image('public/img/projects', 640, 480);
        $object->setImagePath(substr($path, 20));

        return parent::afterInstanciate($object);
    }

    private function randomLanguage(): array
    {
        $languages = [];
        for ($i = 0; $i < rand(1, LanguageFixture::getCount() - 1); $i++) {
            do {
                $id = rand(1, LanguageFixture::getCount());
            } while (in_array($id, array_keys($languages)));

            $languages[$id] = $this->getReference('lang-' . $id);
        }

        return array_values($languages);
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class
        ];
    }
}
