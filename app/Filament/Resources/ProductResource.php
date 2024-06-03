<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    // Icon
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    // Group
    protected static ?string $navigationGroup = 'Products';

    // Sort
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Image
                FileUpload::make('image')->image()->rules('max:1024')
                    ->imageEditor()->imageCropAspectRatio('1:1')
                    ->disk('public')
                    ->directory('product-image')
                    ->columnSpanFull(),
                // ***

                // Name
                TextInput::make('name')
                    ->autocomplete(false)->autofocus()
                    ->minLength(3)->maxLength(255)->unique(ignoreRecord: true)->required(),
                //***

                // Price
                TextInput::make('price')
                    ->autocomplete(false)->maxLength(11)->required()
                    ->prefix('Rp. ')
                    ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2),
                // ***

                // Category
                Select::make('product_category_id')
                    ->relationship('productCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        // Category Name
                        TextInput::make('name')
                            ->autocomplete(false)->autofocus()
                            ->minLength(3)->maxLength(255)->unique(ignoreRecord: true)->required()
                            ->columnSpanFull(),
                        // ***
                    ]),
                // ***

                // Is Available
                Toggle::make('is_available')
                    ->inline(false)
                    ->default(true)
                    ->required(),
                // ***

                // Descripton
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->autosize(),
                // ***
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Index Number
                TextColumn::make('#')
                    ->rowIndex(),
                // ***

                // Image
                ImageColumn::make('image')
                    ->defaultImageUrl(url('/assets/images/logo.png'))
                    ->width(50)
                    ->height(50)
                    ->toggleable(),
                // ***

                // Name
                TextColumn::make('name')
                    ->searchable()->sortable(),
                // ***

                // Price
                TextColumn::make('price')->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    )->sortable(),
                // ***

                // Category
                TextColumn::make('productCategory.name'),
                // ***

                // Total Transactions
                TextColumn::make('orderproducts_count')
                    ->label('Total Transactions')
                    ->counts('orderproducts')
                    ->alignCenter()
                    ->sortable()
                    ->badge(),
                // ***

                // Total Products
                TextColumn::make('orderproducts.qty')
                    ->label('Total Sold')
                    ->getStateUsing(function ($record) {
                        $qtys = $record->orderproducts->sum('qty');
                        $total = $qtys; // Adjust formatting as needed
                        return $total;
                    })
                    ->badge()
                    ->alignCenter(),
                // ***

                // Is Available
                ToggleColumn::make('is_available'),
                // ***
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
