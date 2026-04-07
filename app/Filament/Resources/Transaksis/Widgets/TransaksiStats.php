<?php

namespace App\Filament\Resources\Transaksis\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransaksiStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Kendaraan Masuk', Transaksi::where('status', 'masuk')->count())
                ->description('Jumlah kendaraan yang berada di dalam')
                ->descriptionIcon('heroicon-m-arrow-left-end-on-rectangle')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),

            Stat::make('Kendaraan Keluar', Transaksi::where('status', 'keluar')->count())
                ->description('Jumlah kendaraan yang keluar')
                ->descriptionIcon('heroicon-m-arrow-right-start-on-rectangle')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),

            Stat::make('Total Pendapatan', 'Rp. ' . number_format(Transaksi::where('status', 'keluar')->sum('total_bayar'), 0))
                ->description('Total pendapatan dari transaksi keluar')
                ->descriptionIcon('heroicon-m-Currency-Dollar')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
        ];
    }
}