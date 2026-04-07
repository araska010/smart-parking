<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\JamPadatChart;
use App\Filament\Widgets\StatWidget;
use App\Filament\Widgets\TopMerkChart;
use App\Filament\Widgets\TopModelChart;
use App\Filament\Widgets\TopPlatChart;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            JamPadatChart::class,
            TopPlatChart::class,
            TopMerkChart::class,
            TopModelChart::class,
        ];
    }
}
