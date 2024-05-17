<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Customer;
use Illuminate\Support\ServiceProvider;
use Laravel\Paddle\Cashier;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Cashier::useCustomerModel(
            customerModel: Customer::class,
        );
    }
}
