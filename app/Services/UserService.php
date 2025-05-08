<?php

namespace App\Services;

use App\Models\Results\DataResult;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function getAll(): DataResult
    {
        $users = User::all();

        return new DataResult(
            true,
            200,
            'Users fetched successfully',
            $users->toArray(),
        );
    }
}
