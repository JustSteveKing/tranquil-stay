<?php

declare(strict_types=1);

namespace App\Services;

use JustSteveKing\Ollama\DataObjects\Message;
use JustSteveKing\Ollama\Enums\Role;
use JustSteveKing\Ollama\Requests\Chat;
use JustSteveKing\Ollama\Requests\Prompt;
use JustSteveKing\Ollama\SDK;

final readonly class Ollama
{
    public function __construct(
        private SDK $sdk,
    ) {
    }

    public function ask(string $prompt)
    {
        return $this->sdk->generate(
            prompt: new Prompt(
                model: 'llama3',
                prompt: $prompt,
                format: 'json',
                stream: false,
            ),
        );
    }
}
