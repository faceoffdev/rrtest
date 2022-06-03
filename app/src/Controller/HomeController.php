<?php


declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Spiral\Prototype\Traits\PrototypeTrait;

class HomeController
{
    use PrototypeTrait;

    public function index(UserRepository $users): array
    {
        $user = $users->findById(100);

        return [
            'status' => 200,
            'data'   => [
                'user' => [
                    'id' => $user->id,
                ],
            ],
        ];
    }
}
