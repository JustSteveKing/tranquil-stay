<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('pages:')->group(static function (): void {
    Route::view('/', 'pages.index')->name('home');

    Route::prefix('support')->as('support:')->group(base_path(
        path: 'routes/web/support.php',
    ));
});
