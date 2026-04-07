<?php

namespace App\Filament\Resources\Transaksis\Pages;

use Filament\Schemas\Schema;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use App\Filament\Resources\Transaksis\TransaksiResource;

class TransaksiKeluar extends Page
{
    protected static string $resource = TransaksiResource::class;

    protected string $view = 'filament.resources.transaksis.pages.transaksi-keluar';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Kendaraan')
                    ->schema([
                        TextInput::make('plat_nomor')
                            ->label('Plat Nomor')
                            ->required()
                            ->maxLength(15),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => TransaksiKeluar::route('/'),
        ];
    }
}
