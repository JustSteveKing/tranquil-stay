<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('login', 'pages.auth.login')->name('login');
