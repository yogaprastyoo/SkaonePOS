<?php

namespace App\Filament\Imports;

use App\Models\Stock;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StockImporter extends Importer
{
    protected static ?string $model = Stock::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nama Barang')
                ->requiredMapping()
                ->rules(['required']),

            ImportColumn::make('stock')
                ->label('Stok Barang')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),

            ImportColumn::make('unit')
                ->label('Satuan')
                ->requiredMapping()
                ->rules(['required']),

            ImportColumn::make('unit_price')
                ->label('Harga Satuan')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),

            ImportColumn::make('cost_price')
                ->label('Harga Pokok')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),

            // ImportColumn::make('sort')
            //     ->numeric()
            //     ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Stock
    {
        // return Stock::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Stock();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your stock import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
