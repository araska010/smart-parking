<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class TopModelChart extends ChartWidget
{
    protected ?string $heading = 'Monitoring Model Kendaraan';

    protected function getData(): array
    {
        $data = Transaksi::selectRaw('model, COUNT(*) as total')
            ->groupBy('model')
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
            'labels' => $data->pluck('model')->map(fn($v) => (string) $v),
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
