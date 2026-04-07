<?php

namespace App\Filament\Resources\Transaksis\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Transaksis\TransaksiResource;

class CreateTransaksi extends CreateRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/struk/' . $this->record->id);
    }
    protected function afterCreate(): void
    {
        $area = $this->record->area;

        if ($area->terisi >= $area->kapasitas) {
            throw new \Exception('Area parkir penuh');
        }

        $area->increment('terisi');
    }
}
