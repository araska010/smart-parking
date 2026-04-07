<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DateTimePicker;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('waktu_masuk')
                    ->default(now())
                    ->required()
                    ->disabled()
                    ->hiddenLabel()
                    ->dehydrated()
                    ->prefix('Waktu Masuk: ')
                    ->columnSpanFull(),

                Section::make()
                    ->schema([
                        TextInput::make('plat_nomor')
                            ->label('Plat Nomor')
                            ->required()
                            ->maxLength(15),


                        Select::make('tarif_parkir_id')
                            ->label('Jenis Kendaraan')
                            ->relationship('tarif', 'jenis_kendaraan')
                            ->required(),

                        Select::make('area_parkir_id')
                            ->relationship('area', 'nama_area')
                            ->required(),

                        Hidden::make('user_id')
                            ->default(Auth::id())
                            ->dehydrated(),
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('merk')
                            ->required(),

                        TextInput::make('model')
                            ->required(),

                        TextInput::make('warna')
                            ->required(),
                    ]),
            ]);
    }
}
