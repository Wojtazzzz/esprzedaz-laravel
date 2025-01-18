<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Src\Modules\Pets\Api\Controllers\PetController;

Route::resource('pets', PetController::class, [
    'only' => ['create', 'store', 'edit', 'update', 'destroy'],
]);
