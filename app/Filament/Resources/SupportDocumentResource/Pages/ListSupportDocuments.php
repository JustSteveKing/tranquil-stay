<?php

namespace App\Filament\Resources\SupportDocumentResource\Pages;

use App\Filament\Resources\SupportDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportDocuments extends ListRecords
{
    protected static string $resource = SupportDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
