<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Hash;

use Phpsa\FilamentPasswordReveal\Password;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama')
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Email')
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                        ->autofocus()
                        ->email()
                        ->placeholder('Email')
                        ->maxLength(255)
                        ->minLength(9),
                    Password::make('password')
                        ->label('Password')
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                        ->autofocus()
                        ->password()
                        ->same('confirmPassword')
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->placeholder('Password')
                        ->maxLength(255)
                        ->minLength(9),
                    Password::make('confirmPassword')
                        ->label('Konfirmasi Password')
                        ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                        ->autofocus()
                        ->password()
                        ->placeholder('Konfirmasi Password')
                        ->maxLength(255),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('created_at')->searchable()->sortable(),
                TextColumn::make('updated_at')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
