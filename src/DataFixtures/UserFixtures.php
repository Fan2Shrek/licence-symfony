<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends AbstractFixture
{
    public function __construct(
        private PasswordHasherInterface $passwordHasher,
    ) {
    }

    public function getClass(): string
    {
        return User::class;
    }

    public function getData(): iterable
    {
        yield ['email' => 'admin@admin.fr', 'password' => $this->passwordHasher->hash('admin')];
    }
}
