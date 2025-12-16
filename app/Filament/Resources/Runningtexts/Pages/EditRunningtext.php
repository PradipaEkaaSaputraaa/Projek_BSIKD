<?php

namespace App\Filament\Resources\Runningtexts\Pages;

use App\Filament\Resources\Runningtexts\RunningtextResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRunningtext extends EditRecord
{
    protected static string $resource = RunningtextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
