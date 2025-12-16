<?php

namespace App\Filament\Resources\Notes;

use App\Filament\Resources\Notes\Pages\CreateNote;
use App\Filament\Resources\Notes\Pages\EditNote;
use App\Filament\Resources\Notes\Pages\ListNotes;
use App\Filament\Resources\Notes\Schemas\NoteForm;
use App\Filament\Resources\Notes\Tables\NotesTable;
use App\Models\Note;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // Menggunakan Schema (sesuai pola guru Anda)
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Menggunakan kolom database yang sebenarnya sebagai judul record
    protected static ?string $recordTitleAttribute = 'judul_note'; 

    public static function form(Schema $schema): Schema
    {
        return NoteForm::configure($schema);
    }
    
    // METHOD infolist() DIHAPUS (karena tidak menggunakan View Page)
    // public static function infolist(Schema $schema): Schema { ... }

    public static function table(Table $table): Table
    {
        return NotesTable::configure($table);
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
            'index' => ListNotes::route('/'),
            'create' => CreateNote::route('/create'),
            // ENTRI 'view' DIHAPUS
            'edit' => EditNote::route('/{record}/edit'),
        ];
    }
}