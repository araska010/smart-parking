<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class TopPlatChart extends ChartWidget
{
    protected ?string $heading = 'Monitoring Plat Nomor';

    protected function getData(): array
    {
        $data = Transaksi::selectRaw('plat_nomor, COUNT(*) as total')
            ->groupBy('plat_nomor')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Masuk',
                    'data' => $data->pluck('total')->map(fn($value) => (int) $value),
                ],
            ],
            'labels' => $data->pluck('plat_nomor')->map(fn($v) => (string) $v),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
