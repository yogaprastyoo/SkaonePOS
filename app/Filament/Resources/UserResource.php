<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Icon
    protected static ?string $navigationIcon = 'heroicon-o-users';

    // Sort
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Name
                TextInput::make('name')
                    ->autocomplete(false)->autofocus()
                    ->minLength(3)->required()
                    ->columnSpan(2),
                // ***

                // Email
                TextInput::make('email')
                    ->autocomplete(false)
                    ->email()->unique(ignoreRecord: true)->minLength(5)->required(),
                // ***

                // Role
                Select::make('role')
                    ->options([
                        'owner' => 'Owner',
                        'manager' => 'Manager',
                        'cashier' => 'Cashier',
                    ])->required()->searchable()->noSearchResultsMessage('No role found.'),
                // ***

                // Password
                TextInput::make('password')
                    ->password()->required(fn (string $context): bool => $context === 'create')
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                        $component->state('');
                    })->dehydrateStateUsing(fn ($state) => Hash::make($state))->dehydrated(fn ($state) => filled($state))
                    ->revealable()->hiddenOn('view')
                    ->columnSpan(2),
                // ***

                // PasswordConfirmation
                TextInput::make('password_confirmation')
                    ->password()->same('password')->required(fn (string $context): bool => $context === 'create')
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                        $component->state('');
                    })->dehydrateStateUsing(fn ($state) => Hash::make($state))->dehydrated(fn ($state) => filled($state))
                    ->revealable()->hiddenOn('view')
                    ->columnSpan(2),
                // ***
            ])->columns([
                'default' => 2,
                'md' => 4,
                'lg' => 4,
                'xl' => 4,
                '2xl' => 4,
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

                // Name
                TextColumn::make('name')
                    ->searchable()->sortable(),
                // ***

                // Email
                TextColumn::make('email')
                    ->searchable(),
                // ***

                // Role
                TextColumn::make('role')
                    ->color(fn (string $state): string => match ($state) {
                        'owner' => 'danger',
                        'manager' => 'warning',
                        'cashier' => 'success',
                    })->searchable()->badge(),
                // ***
            ])
            ->filters([
                // RoleFilter
                SelectFilter::make('role')
                    ->options([
                        'owner' => 'Owner',
                        'manager' => 'Manager',
                        'cashier' => 'Cashier',
                    ])->searchable()
                // ***
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
    public static function getRelations(): array
    {
        return [
            OrdersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),

                TextEntry::make('email'),

                TextEntry::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'owner' => 'danger',
                        'manager' => 'warning',
                        'cashier' => 'success',
                    }),

            ])->columns(3);
    }
}
