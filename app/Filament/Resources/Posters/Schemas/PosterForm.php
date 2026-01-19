<?php

// Pastikan namespace adalah PLURAL
namespace App\Filament\Resources\Posters\Schemas; 

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class PosterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                TextInput::make('judul_poster')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Poster'),
                    
                // Ini adalah komponen untuk upload gambar
                FileUpload::make('path_poster') 
                    ->required()
                    ->image() // Hanya menerima file gambar
                    ->directory('posters') // Menyimpan gambar di storage/app/public/posters
                    ->disk('public') // Menyimpan ke public disk (pastikan sudah 'php artisan storage:link')
                    ->columnSpanFull() 
                    ->label('File Gambar Poster'),

                Toggle::make('is_active')
                ->label('Tampilkan di TV?')
                ->default(true)
                ->onColor('success')
                ->columnSpanFull(),
            ]);
    }
}