<?php

namespace App\Filament\Resources\TarifParkirs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class TarifParkirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_kendaraan')
                ->required(),
                TextInput::make('tarif_per_jam')
                ->numeric()
                ->prefix('Rp. ')
                ->required(),
            ]);
    }
}
