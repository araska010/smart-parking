<?php

namespace App\Filament\Resources\Inputs;

use App\Filament\Resources\Transaksis\Pages\CreateTransaksi;
use App\Models\Transaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

class InputResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationLabel = 'Masuk';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlusCircle;
    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::PlusCircle;

    protected static ?string $recordTitleAttribute = 'plat_nomor';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('create_transaksi');
    }

    protected function authorizeAccess(): void
    {
        abort_unless(auth()->user()->can('create_transaksi'), 403);
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
            'index' => CreateTransaksi::route('/create'),
        ];
    }
}
