<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('bookings/{booking}/check-in')->name('bookings.check-in');
