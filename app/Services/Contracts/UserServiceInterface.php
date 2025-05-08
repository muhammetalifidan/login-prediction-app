<?php

namespace App\Services\Contracts;

use App\Models\Results\DataResult;

interface UserServiceInterface
{
    public function getAll(): DataResult;
}
