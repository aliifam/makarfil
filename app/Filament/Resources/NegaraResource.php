<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NegaraResource\Pages;
use App\Filament\Resources\NegaraResource\RelationManagers;
use App\Models\Negara;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NegaraResource extends Resource
{
    protected static ?string $model = Negara::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama')
                        ->label('Nama Negara')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama Negara')
                        ->maxLength(255),
                    TextInput::make('kode')
                        ->label('Kode Negara')
                        ->required()
                        ->placeholder('Kode Negara')
                        ->maxLength(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->formatStateUsing(fn (string $state): string => __(strtoupper($state)))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable(),
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
            'index' => Pages\ListNegaras::route('/'),
            'create' => Pages\CreateNegara::route('/create'),
            'edit' => Pages\EditNegara::route('/{record}/edit'),
        ];
    }    
}
