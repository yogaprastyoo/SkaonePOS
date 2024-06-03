<?php

namespace App\Filament\Resources;

use App\Filament\Exports\StockExporter;
use App\Filament\Imports\StockImporter;
use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Stock;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    // Icon
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    // Sort
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name
                TextInput::make('name')
                    ->autocomplete(false)->autofocus()->maxLength(255)->unique(ignoreRecord: true)
                    ->required()->label('Nama Barang'),
                // ***

                // Stock
                TextInput::make('stock')
                    ->autocomplete(false)->maxLength(11)->required()
                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2)
                    ->label('Stok Barang'),
                // ***

                // Unit
                TextInput::make('unit')
                    ->autocomplete(false)->minLength(1)->maxLength(11)
                    ->required()->label('Satuan'),
                // ***

                // Cost Price
                TextInput::make('cost_price')
                    ->autocomplete(false)->minLength(0)->maxLength(11)
                    ->required()->prefix('Rp.')
                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set, $get) => $set('unit_price', $get('stock') > 0 ? $state / $get('stock') : 0))
                    ->label('Harga Pokok')
                    ->columnSpan([
                        'default' => 1,
                        'md' => 2,
                        'lg' => 2,
                        'xl' => 2,
                        '2xl' => 2,
                    ]),
                // ***

                // Unit Price
                TextInput::make('unit_price')
                    ->default(0)
                    ->autocomplete(false)->minLength(1)->maxLength(11)
                    ->required()->prefix('Rp.')
                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2)
                    ->label('Harga Satuan')->disabled('create')->dehydrated(),
                // ***
            ])->columns([
                'default' => 1,
                'md' => 3,
                'lg' => 3,
                'xl' => 3,
                '2xl' => 3,
            ]);;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(StockImporter::class),

                ExportAction::make()
                    ->exporter(StockExporter::class)
            ])
            ->columns([
                // Index Number
                TextColumn::make('#')
                    ->rowIndex(),
                // ***

                // Name
                TextColumn::make('name')
                    ->searchable()->sortable()
                    ->label('Nama Barang'),
                // ***

                // Stock
                TextColumn::make('stock')
                    ->label('Stok Barang')->sortable(),
                // =========== # Conditional Badge Color # =========== //
                // ->color(fn (string $state, $get): string => match ($state) {
                //     $state => $state < 10 ? 'danger' : 'success',
                // })->badge(),
                // =========== # # =========== //
                // ***

                // Unit
                TextColumn::make('unit')
                    ->searchable()
                    ->label('Satuan'),
                // ***

                // Unit Cost
                TextColumn::make('unit_price')
                    ->label('Harga Satuan')->sortable()->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    ),
                // ***

                // Cost Price
                TextColumn::make('cost_price')
                    ->label('Harga Pokok')->sortable()->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    ),
                // ***
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\ViewAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(StockExporter::class)
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStocks::route('/'),
        ];
    }
}
