<?php

use App\Http\Controllers\Api\UserLoginPredictionController;
use Illuminate\Support\Facades\Route;

Route::get('/predictions', [UserLoginPredictionController::class, 'index']);
