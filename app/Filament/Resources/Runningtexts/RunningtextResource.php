<?php

namespace App\Filament\Resources\Runningtexts;

use App\Filament\Resources\Runningtexts\Pages\CreateRunningtext; 
use App\Filament\Resources\Runningtexts\Pages\EditRunningtext;   
use App\Filament\Resources\Runningtexts\Pages\ListRunningtexts; 
use App\Filament\Resources\Runningtexts\Schemas\RunningtextForm; 
use App\Filament\Resources\Runningtexts\Tables\RunningtextTable;
use App\Models\Runningtext; // Pastikan Model Runningtext sudah diimport
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RunningtextResource extends Resource
{
    protected static ?string $model = Runningtext::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Menggunakan kolom isitext sebagai judul record (karena ini kolom utama)
    protected static ?string $recordTitleAttribute = 'isitext'; 

    public static function form(Schema $schema): Schema
    {
        return RunningtextForm::configure($schema);
    }
    
    // Method infolist() dihilangkan (sesuai permintaan, tanpa View Page)

    public static function table(Table $table): Table
    {
        return RunningtextTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRunningtexts::route('/'),
            'create' => CreateRunningtext::route('/create'),
            // Entri 'view' dihilangkan
            'edit' => EditRunningtext::route('/{record}/edit'),
        ];
    }
}