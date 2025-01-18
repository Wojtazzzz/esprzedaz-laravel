<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

abstract class Controller
{
    protected function loadViews(array $namespaces): void
    {
        foreach ($namespaces as $namespace => $path) {
            View::addNamespace($namespace, $path);
        }
    }
}
