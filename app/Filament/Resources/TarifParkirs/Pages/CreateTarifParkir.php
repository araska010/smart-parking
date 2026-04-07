<?php

namespace App\Filament\Resources\TarifParkirs\Pages;

use App\Filament\Resources\TarifParkirs\TarifParkirResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTarifParkir extends CreateRecord
{
    protected static string $resource = TarifParkirResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
