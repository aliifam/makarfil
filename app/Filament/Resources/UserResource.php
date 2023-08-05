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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                        ->required()
                        ->autofocus()
                        ->email()
                        ->placeholder('Email')
                        ->maxLength(255),
                    TextInput::make('passsword')
                        ->label('Password')
                        ->required()
                        ->autofocus()
                        ->password()
                        ->placeholder('Password')
                        ->maxLength(255),
                    TextInput::make('confirmPasssword')
                        ->label('Konfirmasi Password')
                        ->required()
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
                //
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
            //
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
