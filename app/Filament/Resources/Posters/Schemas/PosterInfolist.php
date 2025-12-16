<?php

namespace App\Filament\Resources\Posters\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PosterInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('judul_poster'),
                TextEntry::make('path_poster')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
