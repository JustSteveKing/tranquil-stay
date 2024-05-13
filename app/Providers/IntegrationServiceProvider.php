<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JustSteveKing\Ollama\SDK;

final class IntegrationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            abstract: SDK::class,
            concrete: fn () => (new SDK(
                apiToken: '',
                url: 'http://localhost:11434',
            ))->setup(),
        );
    }
}
