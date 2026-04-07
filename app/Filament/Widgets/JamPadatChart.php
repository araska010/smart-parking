<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class JamPadatChart extends ChartWidget
{
    protected ?string $heading = 'Kepadatan Parkir per Jam';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $labels = range(0, 23);
        $dataPerJam = array_fill(0, 24, 0);

        $transaksiPerJam = Transaksi::selectRaw('HOUR(waktu_masuk) as jam, COUNT(*) as total')
            ->groupBy('jam')
            ->orderBy('jam')
            ->get();

        foreach ($transaksiPerJam as $t) {
            $dataPerJam[$t->jam] = (int) $t->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Kendaraan',
                    'data' => $dataPerJam,
                ],
            ],
        ];
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