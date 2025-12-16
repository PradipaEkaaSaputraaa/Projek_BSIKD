<?php

namespace App\Filament\Resources\Notes\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                TextInput::make('judul_note')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Catatan'),

                RichEditor::make('isi')
                    ->required()
                    ->columnSpanFull() 
                    ->label('Isi Catatan'),
                
                Toggle::make('lokasi')
                    ->label('Tampilkan Lokasi')
                    ->default(false),
            ]);
    }
}