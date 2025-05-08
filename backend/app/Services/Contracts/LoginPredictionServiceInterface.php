<?php

namespace App\Services\Contracts;

use App\Models\Results\DataResult;

interface LoginPredictionServiceInterface
{
    public function getAllPredictions(): DataResult;
}
