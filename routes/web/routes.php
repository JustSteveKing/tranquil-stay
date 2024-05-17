<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('pages:')->group(static function (): void {
    Route::middleware(['guest'])->prefix('auth')->as('auth:')->group(base_path(
        path: 'routes/web/auth.php',
    ));

    Route::middleware(['auth'])->group(static function (): void {
        Route::view('/', 'pages.index')->name('home');
    });

    Route::as('client:')->group(base_path(
        path: 'routes/web/client.php',
    ));

    Route::prefix('support')->as('support:')->group(base_path(
        path: 'routes/web/support.php',
    ));
});
