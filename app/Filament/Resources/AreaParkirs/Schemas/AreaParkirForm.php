<?php

namespace App\Filament\Resources\AreaParkirs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class AreaParkirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_area')
                ->required(),
                TextInput::make('kapasitas')
                ->numeric()
                ->minValue(0)
                ->required(),
            ]);
    }
}
