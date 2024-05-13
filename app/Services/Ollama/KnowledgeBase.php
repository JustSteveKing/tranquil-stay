<?php

declare(strict_types=1);

namespace App\Services\Ollama;

use App\Services\Ollama;
use JustSteveKing\Ollama\Requests\Prompt;
use JustSteveKing\Ollama\Responses\GenerateResponse;

final readonly class KnowledgeBase
{
    public function __construct(
        private Ollama $ollama,
    ) {
    }

    public function ask(string $prompt): GenerateResponse
    {
        return $this->ollama->sdk()->generate(
            prompt: new Prompt(
                model: 'llama3',
                prompt: $prompt,
                system: $this->ollama->system(),
                format: 'json',
                stream: false,
            ),
        );
    }
}
