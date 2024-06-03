<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderProductRelationManager extends RelationManager
{
    protected static string $relationship = 'OrderProduct';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('product_id')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                // Index Number
                TextColumn::make('#')
                    ->rowIndex(),
                // ***

                // Product Name
                TextColumn::make('product.name'),
                // ***

                // QTY
                TextColumn::make('qty')
                    ->sortable(),
                // ***

                // Product Price
                TextColumn::make('product.price')->prefix('Rp. ')
                    ->label('Price/QTY')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    )->sortable(),
                // ***

                // Product Price Total
                TextColumn::make('total')->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    )->sortable(),
                // ***
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
