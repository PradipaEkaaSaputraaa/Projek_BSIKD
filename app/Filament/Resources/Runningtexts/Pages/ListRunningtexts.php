<?php

namespace App\Filament\Resources\Runningtexts\Pages;

use App\Filament\Resources\Runningtexts\RunningtextResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRunningtexts extends ListRecords
{
    protected static string $resource = RunningtextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
