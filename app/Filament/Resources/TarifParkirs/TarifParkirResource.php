<?php

namespace App\Filament\Resources\TarifParkirs;

use App\Filament\Resources\TarifParkirs\Pages\CreateTarifParkir;
use App\Filament\Resources\TarifParkirs\Pages\EditTarifParkir;
use App\Filament\Resources\TarifParkirs\Pages\ListTarifParkirs;
use App\Filament\Resources\TarifParkirs\Schemas\TarifParkirForm;
use App\Filament\Resources\TarifParkirs\Tables\TarifParkirsTable;
use App\Models\TarifParkir;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TarifParkirResource extends Resource
{
    protected static ?string $model = TarifParkir::class;

    protected static ?string $navigationLabel = 'Tarif Parkir';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedReceiptPercent;
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::ReceiptPercent;

    protected static ?string $recordTitleAttribute = 'jenis_kendaraan';

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Schema $schema): Schema
    {
        return TarifParkirForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TarifParkirsTable::configure($table);
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
            'index' => ListTarifParkirs::route('/'),
            'create' => CreateTarifParkir::route('/create'),
            'edit' => EditTarifParkir::route('/{record}/edit'),
        ];
    }
}
