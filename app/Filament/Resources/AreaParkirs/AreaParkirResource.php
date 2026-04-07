<?php

namespace App\Filament\Resources\AreaParkirs;

use App\Filament\Resources\AreaParkirs\Pages\CreateAreaParkir;
use App\Filament\Resources\AreaParkirs\Pages\EditAreaParkir;
use App\Filament\Resources\AreaParkirs\Pages\ListAreaParkirs;
use App\Filament\Resources\AreaParkirs\Schemas\AreaParkirForm;
use App\Filament\Resources\AreaParkirs\Tables\AreaParkirsTable;
use App\Models\AreaParkir;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AreaParkirResource extends Resource
{
    protected static ?string $model = AreaParkir::class;

    protected static ?string $navigationLabel = 'Area Parkir';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::MapPin;

    protected static ?string $recordTitleAttribute = 'nama_area';

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function form(Schema $schema): Schema
    {
        return AreaParkirForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AreaParkirsTable::configure($table);
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
            'index' => ListAreaParkirs::route('/'),
            'create' => CreateAreaParkir::route('/create'),
            'edit' => EditAreaParkir::route('/{record}/edit'),
        ];
    }
}
