<?php

namespace App\Filament\Exports;

use App\Models\Transaksi;
use Illuminate\Foundation\Auth\User as AuthUser;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class TransaksiExporter extends Exporter
{
    protected static ?string $model = Transaksi::class;

    public static function canExport(AuthUser $authUser): bool
    {
        return $authUser->can('export_transaksi');
    }


    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('No'),
            ExportColumn::make('plat_nomor')
                ->label('Plat'),
            ExportColumn::make('tarif.jenis_kendaraan')
                ->label('Jenis'),
            ExportColumn::make('area.nama_area')
                ->label('Area'),
            ExportColumn::make('merk'),
            ExportColumn::make('model'),
            ExportColumn::make('warna'),
            ExportColumn::make('user.name')
                ->label('Nama Petugas'),
            ExportColumn::make('waktu_masuk')
                ->label('Masuk'),
            ExportColumn::make('waktu_keluar')
                ->label('Keluar'),
            ExportColumn::make('durasi_jam')
                ->label('Durasi')
                ->formatStateUsing(function ($state) {
                    if (!$state) return '-';

                    $jam = floor($state / 60);
                    $menit = $state % 60;

                    return ($jam ? $jam . 'jam' : '') .
                        ($menit ? $menit . 'menit' : '');
                }),
            ExportColumn::make('total_bayar')
                ->label('Total'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your transaksi export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
