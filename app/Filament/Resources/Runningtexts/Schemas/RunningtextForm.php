<?php

namespace App\Filament\Resources\Runningtexts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RunningtextForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                Textarea::make('isitext')
                    ->required()
                    ->rows(5) // Berikan 5 baris untuk area input
                    ->maxLength(2048) // Sesuaikan jika Anda menggunakan varchar(255)
                    ->columnSpanFull() // Ambil lebar penuh
                    ->label('Isi Teks Berjalan'),
            ]);
    }
}