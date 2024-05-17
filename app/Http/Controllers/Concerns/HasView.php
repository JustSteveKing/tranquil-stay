<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concerns;

use Illuminate\Contracts\View\Factory;

trait HasView
{
    public function __construct(
        protected readonly Factory $factory,
    ) {}
}
