<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

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

                    Toggle::make('is_active')
                    ->label('Tampilkan di TV?')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->columnSpanFull(),
            ]);
    }
}
