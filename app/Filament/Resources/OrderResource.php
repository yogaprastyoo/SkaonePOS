<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderProductRelationManager;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $label = "Invoice";

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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

                // No order
                TextColumn::make('no_order')
                    ->searchable()->sortable(),
                // ***

                // Cashier
                TextColumn::make('user.name')
                    ->label('Cashier')
                    ->searchable(),
                // ***

                // Grand Total
                TextColumn::make('grand_total')->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    )->sortable(),
                // ***

                // Payment
                TextColumn::make('payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tunai' => 'success',
                        'qris' => 'info',
                    }),
                // ***

                // Created at
                TextColumn::make('created_at')
                    ->label('Order at')
                    ->date('D, d-m-Y • H:i:s')
                    ->sortable()
                    ->searchable(),
                // ***
            ])
            ->filters([
                // Filter by Created at
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_at_from')
                            ->label('Order at from')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->maxDate(now())
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_at_until')
                            ->label('Order at until')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->maxDate(now())
                            ->default(now())
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_at_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_at_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_at_from'] ?? null) {
                            $indicators['created_at_from'] = 'Time in from ' . Carbon::parse($data['created_at_from'])->toFormattedDateString();
                        }
                        if ($data['created_at_until'] ?? null) {
                            $indicators['created_at_until'] = 'Time out until ' . Carbon::parse($data['created_at_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                // ***

                // Filter by Cashier
                SelectFilter::make('Cashier')
                    ->relationship('user', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                // ***

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\EditAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->groups([
                'user.name',
                Group::make('created_at')
                    ->label('Order date')
                    ->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultGroup('created_at', '')
            ->recordAction(Tables\Actions\ViewAction::class)
            ->recordUrl(null);
    }


    public static function getRelations(): array
    {
        return [
            OrderProductRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            // 'create' => Pages\CreateOrder::route('/create'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('no_order'),

                TextEntry::make('user.name')
                    ->label('Cashier'),

                TextEntry::make('created_at')
                    ->label('Order Date')
                    ->date('d-m-Y • H:i:s'),

                TextEntry::make('payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tunai' => 'success',
                        'qris' => 'info',
                    }),

                TextEntry::make('grand_total')
                    ->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    ),

                TextEntry::make('pay')
                    ->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    ),

                TextEntry::make('change')
                    ->prefix('Rp. ')
                    ->numeric(
                        decimalPlaces: 0,
                        thousandsSeparator: '.',
                    ),

            ])->columns([
                'default' => 2,
                'sm' => 3,
                'md' => 4,
                'lg' => 4,
                'xl' => 4,
                '2xl' => 4,
            ]);
    }
}
