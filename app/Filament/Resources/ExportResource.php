<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExportResource\Pages;
use App\Filament\Resources\ExportResource\RelationManagers;
use App\Models\Export;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExportResource extends Resource
{
    protected static ?string $model = Export::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?int $navigationSort = 3;

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

                // File Name
                TextColumn::make('file_name')
                    ->sortable()
                    ->searchable(),
                // ***

                // Total Rows
                TextColumn::make('total_rows')
                    ->badge(),
                // ***

                // Processed Rows
                TextColumn::make('processed_rows')
                    ->badge(),
                // ***

                // Successful Rows
                TextColumn::make('successful_rows')
                    ->badge(),
                // ***

                // Completed at
                TextColumn::make('completed_at')
                    ->sortable()
                    ->dateTime(),
                // ***
            ])
            ->filters([
                // Filter by Created at
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_at_from')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->maxDate(now())
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_at_until')
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
                            $indicators['created_at_from'] = 'Created at from ' . Carbon::parse($data['created_at_from'])->toFormattedDateString();
                        }
                        if ($data['created_at_until'] ?? null) {
                            $indicators['created_at_until'] = 'Created at until ' . Carbon::parse($data['created_at_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                // ***
            ])
            ->actions([
                ActionGroup::make([
                    // Action for View
                    Tables\Actions\ViewAction::make(),
                    // ***

                    // Action for Download file .csv
                    Action::make('download_csv')
                        ->label('Download .csv')
                        ->color('info')
                        ->icon('heroicon-s-document-arrow-down')
                        ->url(fn (Export $export): string => route('filament.exports.download', $export->id) . '?format=csv')
                        ->openUrlInNewTab(),
                    // ***

                    // Action for Download file .xlsx
                    Action::make('download_xlsx')
                        ->label('Download .xlsx')
                        ->color('info')
                        ->icon('heroicon-s-document-arrow-down')
                        ->url(fn (Export $export): string => route('filament.exports.download', $export->id) . '?format=xlsx')
                        ->openUrlInNewTab(),
                    // ***

                    // Action for Delete
                    Tables\Actions\DeleteAction::make(),
                    // ***

                    // Action for Edit
                    // Tables\Actions\EditAction::make(),
                    // ***
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageExports::route('/'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('file_name'),

                TextEntry::make('user.name')
                    ->label('Exporter'),

                TextEntry::make('created_at')
                    ->dateTime(),

                TextEntry::make('completed_at')
                    ->dateTime(),

                TextEntry::make('id')
                    ->label('Export ID')
                    ->badge()
                    ->numeric(),

                TextEntry::make('total_rows')
                    ->badge()
                    ->numeric(),

                TextEntry::make('processed_rows')
                    ->badge()
                    ->numeric(),

                TextEntry::make('successful_rows')
                    ->badge()
                    ->numeric(),

                TextEntry::make('download_csv')
                    ->label('Download .csv')
                    ->default('Download as .csv')
                    ->color('info')
                    ->badge()
                    ->icon('heroicon-s-document-arrow-down')
                    ->url(fn (Export $export): string => route('filament.exports.download', $export->id) . '?format=csv')
                    ->openUrlInNewTab(),

                TextEntry::make('download_xlsx')
                    ->label('Download .xlsx')
                    ->default('Download as .xlsx')
                    ->color('info')
                    ->badge()
                    ->icon('heroicon-s-document-arrow-down')
                    ->url(fn (Export $export): string => route('filament.exports.download', $export->id) . '?format=xlsx')
                    ->openUrlInNewTab(),
            ])->columns([
                'default' => 2,
                'md' => 4,
                'lg' => 4,
                'xl' => 4,
                '2xl' => 4,
            ]);
    }
}
