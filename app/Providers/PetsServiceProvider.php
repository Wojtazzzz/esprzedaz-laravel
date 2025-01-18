<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Modules\Pets\Domain\PetClient;
use Src\Modules\Pets\Infrastructure\PetSwaggerClient;

class PetsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PetClient::class, PetSwaggerClient::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
