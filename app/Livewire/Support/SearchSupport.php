<?php

declare(strict_types=1);

namespace App\Livewire\Support;

use App\Services\Ollama;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class SearchSupport extends Component
{
    public null|string $prompt = null;

    public string $response = '';

    public function submit(Ollama $ollama): void
    {
        $this->response = $ollama->ask($this->prompt)->response;
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.support.search-support',
        );
    }
}
