<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\SupportDocument;
use App\Services\Ollama\KnowledgeBase;
use JustSteveKing\Ollama\SDK;

final readonly class Ollama
{
    public function __construct(
        private SDK $sdk,
    ) {
    }

    public function knowledgeBase(): KnowledgeBase
    {
        return new KnowledgeBase(
            ollama: $this,
        );
    }

    public function sdk(): SDK
    {
        return $this->sdk;
    }

    public function system(): string
    {
        $documents = SupportDocument::query()->get();

        $prompt = '';

        foreach ($documents as $document) {
            $prompt .= "Question: {$document->question}, Answer: {$document->answer}\n";
        }

        return "This is the contents of the knowledge base: {$prompt}";
    }
}
