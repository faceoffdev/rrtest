<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\UserRepository;

#[Cycle\Entity(table: 'users', repository: UserRepository::class)]
#[Cycle\Table\Index(columns: ['email'], unique: true)]
class User
{
    #[Cycle\Column(type: 'bigPrimary')]
    public int $id;

    #[Cycle\Column(type: 'string')]
    public string $email;

    #[Cycle\Column(type: 'string', name: 'password')]
    public string $passwordHash;

    #[Cycle\Column(type: 'string', name: 'first_name')]
    public string $firstName;

    #[Cycle\Column(type: 'string', name: 'last_name')]
    public string $lastName;
}
