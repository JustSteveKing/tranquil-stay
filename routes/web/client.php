<?php

declare(strict_types=1);

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('rooms')->as('rooms:')->group(static function (): void {
    Route::get('{room}/book', \App\Http\Controllers\Client\Reservations\Rooms\BookingController::class)->name('book');
});

Route::get('/bookings/{booking}/pay', function (Request $request, Booking $booking) {
    $checkout = $request->user()->checkout(
        $booking->cost,
    )->customData(['room' => $booking->room->toArray(), 'booking_id' => $booking->id]);

    return view('pages.client.billing.index', ['checkout' => $checkout]);
})->name('checkout');
