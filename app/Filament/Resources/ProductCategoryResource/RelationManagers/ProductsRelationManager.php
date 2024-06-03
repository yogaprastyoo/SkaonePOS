<?php

namespace App\Filament\Resources\ProductCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'Products';

    public function form(Form $form): Form
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

                // Description
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->autosize(),
                // ***
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
            ]);
    }
}
