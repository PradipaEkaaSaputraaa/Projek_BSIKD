<?php

// Pastikan namespace adalah PLURAL
namespace App\Filament\Resources\Posters; 

use BackedEnum;
use App\Filament\Resources\Posters\Pages\CreatePoster;
use App\Filament\Resources\Posters\Pages\EditPoster;
use App\Filament\Resources\Posters\Pages\ListPosters;
// Impor skema Form dan Table yang akan kita definisikan
use App\Filament\Resources\Posters\Schemas\PosterForm; 
use App\Filament\Resources\Posters\Tables\PosterTable; 
use App\Models\Poster;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PosterResource extends Resource
{
    protected static ?string $model = Poster::class;
    
    // Icon (Anda bisa memilih icon lain jika mau)
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'judul_poster'; 
    
    // Pastikan folder Pages sudah Poster/Pages

    public static function form(Schema $schema): Schema
    {
        return PosterForm::configure($schema); // Panggil class Form Singular
    }
    
    public static function table(Table $table): Table
    {
        return PosterTable::configure($table); // Panggil class Table Singular
    }
    
    // ... (metode getRelations dihilangkan)

    public static function getPages(): array
    {
        return [
            'index' => ListPosters::route('/'),
            'create' => CreatePoster::route('/create'),
            // 'view' => ViewPoster::route('/{record}'), // Dihilangkan
            'edit' => EditPoster::route('/{record}/edit'),
        ];
    }
    
    // ... (metode lain dihilangkan)
}