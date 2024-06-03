<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'Orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('no_order')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_order')
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
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Order $order): string => route('filament.dashboard.resources.orders.view', $order->id)),

                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                Group::make('created_at')
                    ->label('Order date')
                    ->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultGroup('created_at', '');
    }
}
