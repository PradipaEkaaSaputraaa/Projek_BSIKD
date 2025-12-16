<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tgl')
                    ->required(),
                TextInput::make('jam')
                    ->default(null),
                TextInput::make('isi_agenda')
                    ->required(),
            ]);
    }
}
