<?php

namespace App\Filament\Resources\Transaksis\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use App\Filament\Resources\Transaksis\TransaksiResource;
use App\Filament\Resources\Transaksis\Widgets\TransaksiStats;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;

    public function getHeaderWidgets(): array
    {
        return [
            TransaksiStats::class
        ];
    }

    public function getTitle(): string
    {
        return 'Transaksi';
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),

            'motor' => Tab::make('Motor')
                ->modifyQueryUsing(
                    fn($query) => $query->whereHas('tarif', fn($q) => $q->where('jenis_kendaraan', 'motor'))
                ),

            'mobil' => Tab::make('Mobil')
                ->modifyQueryUsing(
                    fn($query) => $query->whereHas('tarif', fn($q) => $q->where('jenis_kendaraan', 'mobil'))
                ),

            'a' => Tab::make('Blok A')
                ->modifyQueryUsing(
                    fn($query) => $query->whereHas('area', fn($q) => $q->where('nama_area', 'blok a'))
                ),

            'b' => Tab::make('Blok B')
                ->modifyQueryUsing(
                    fn($query) => $query->whereHas('area', fn($q) => $q->where('nama_area', 'blok b'))
                ),

            'c' => Tab::make('Blok C')
                ->modifyQueryUsing(
                    fn($query) => $query->whereHas('area', fn($q) => $q->where('nama_area', 'blok c'))
                ),
        ];
    }
}
