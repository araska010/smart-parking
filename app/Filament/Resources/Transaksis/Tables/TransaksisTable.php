<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\TransaksiExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use Illuminate\Support\Facades\Auth;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->columns([
                ColumnGroup::make('Data Kendaraan', [
                    TextColumn::make('kode_parkir')
                        ->label('Kode Parkir')
                        ->searchable()
                        ->copyable(),
                        
                    TextColumn::make('plat_nomor')
                        ->label('Plat')
                        ->searchable(),

                    TextColumn::make('tarif.jenis_kendaraan')
                        ->label('Jenis')
                        ->searchable(),

                    TextColumn::make('merk')
                        ->searchable(),

                    TextColumn::make('model')
                        ->searchable(),

                    TextColumn::make('warna')
                        ->searchable(),
                ]),

                TextColumn::make('tarif.tarif_per_jam')
                    ->label('Tarif Per Jam')
                    ->money('IDR')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('area.nama_area'),

                TextColumn::make('waktu_masuk')
                    ->time('H:i'),

                TextColumn::make('waktu_keluar')
                    ->time('H:i')
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->color(fn(string $state): string => match ($state) {
                        'masuk' => 'info',
                        'keluar' => 'danger',
                    }),

                TextColumn::make('total_bayar')
                    ->money('IDR')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('durasi_jam')
                    ->label('Durasi')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';

                        $jam = floor($state / 60);
                        $menit = $state % 60;

                        return ($jam ? $jam . 'jam' : '') .
                            ($menit ? $menit . 'menit' : '');
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('periode')
                    ->form([
                        Select::make('periode')
                            ->label('Periode')
                            ->options([
                                'harian' => 'Harian',
                                'bulanan' => 'Bulanan',
                                'tahunan' => 'Tahunan',
                            ])
                            ->reactive()
                            ->required(),

                        DatePicker::make('tanggal')
                            ->visible(fn($get) => $get('periode') === 'harian'),

                        Select::make('bulan')
                            ->options([
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ])
                            ->visible(fn($get) => $get('periode') === 'bulanan'),

                        TextInput::make('tahun')
                            ->numeric()
                            ->visible(
                                fn($get) =>
                                in_array($get('periode'), ['bulanan', 'tahunan'])
                            ),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match ($data['periode'] ?? null) {
                            'harian' => $query->whereDate('waktu_masuk', $data['tanggal']),
                            'bulanan' => $query
                                ->whereMonth('waktu_masuk', $data['bulan'])
                                ->whereYear('waktu_masuk', $data['tahun']),
                            'tahunan' => $query->whereYear('waktu_masuk', $data['tahun']),
                            default => $query,
                        };
                    }),
            ])

            ->recordActions([
                

                Action::make('keluar')
                    ->label('Keluar')
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->authorize(fn() => Auth::user()->can('keluar'))
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'masuk')
                    ->action(fn($record) => $record->prosesKeluar())
                    ->requiresConfirmation(),

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->before(function ($record) {
                            if ($record->status === 'masuk') {
                                DB::table('area_parkirs')
                                    ->where('id', $record->area_parkir_id)
                                    ->decrement('terisi');
                            }
                        }),
                    Action::make('struk')
                        ->label('Cetak Struk')
                        ->icon('heroicon-o-printer')
                        ->url(fn($record) => url('/struk/' . $record->id))
                        ->authorize(fn() => Auth::user()->can('cetak')),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Rekap Data')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->exporter(TransaksiExporter::class)
                    ->visible(fn() => Auth::user()->can('export_data'))
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
                    ->fileName(fn() => 'rekap-transaksi-parkir-' . now()->format('Y-m-d'))
            ]);
    }
}
