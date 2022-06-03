<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\User;
use Cycle\ORM\Select\Repository;

class UserRepository extends Repository
{
    public function findById(int $id): ?User
    {
        return $this->findOne(['id' => $id]);
    }
}
