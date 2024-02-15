<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

abstract class AbstractFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $object = new ($this->getClass())(...$data);
            $this->afterInstanciate($object);

            $manager->persist($object);
        }

        $manager->flush();
    }

    abstract public function getData(): iterable;

    abstract public function getClass(): string;

    public function afterInstanciate(object $object): object
    {
        return $object;
    }
}
