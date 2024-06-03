<?php

namespace App\Filament\Resources;

use App\Filament\Imports\ProductCategoryImporter;
use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Filament\Resources\ProductCategoryResource\RelationManagers\ProductsRelationManager;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    // Icon
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // Group
    protected static ?string $navigationGroup = 'Products';

    // Sort
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name
                TextInput::make('name')
                    ->autocomplete(false)->autofocus()
                    ->minLength(3)->maxLength(255)->unique(ignoreRecord: true)->required()
                    ->columnSpanFull(),
                //***
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Index Number
                TextColumn::make('#')
                    ->rowIndex(),
                //***

                // Name
                TextColumn::make('name')
                    ->searchable(),
                // ***

                // Total Products
                TextColumn::make('products_count')
                    ->label('Total Products')
                    ->counts('products')
                    ->alignCenter()
                    ->sortable()
                    ->badge()
                // ***
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()->hidden(fn ($record) => $record->products()->exists()),
                ])->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'view' => Pages\ViewProductCategory::route('/{record}'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
