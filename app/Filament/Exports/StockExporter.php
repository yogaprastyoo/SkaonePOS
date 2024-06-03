<?php

namespace App\Filament\Exports;

use App\Models\Stock;
use Carbon\Carbon;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StockExporter extends Exporter
{
    protected static ?string $model = Stock::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),

            ExportColumn::make('name')
                ->label('Nama Barang'),

            ExportColumn::make('stock')
                ->label('Stok Barang'),

            ExportColumn::make('unit')
                ->label('Satuan'),

            ExportColumn::make('unit_price')
                ->label('Harga Satuan'),

            ExportColumn::make('cost_price')
                ->label('Harga Pokok'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your stock export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        $today = Carbon::now()->format('Y-m-d');
        $count = Export::whereDate('created_at', $today)->count();

        $name = 'stock-' . Carbon::now()->format('dmy') . '-' . $count . '.csv';
        return $name;
    }
}
