<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KotaResource\Pages;
use App\Filament\Resources\KotaResource\RelationManagers;
use App\Models\Kota;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KotaResource extends Resource
{
    protected static ?string $model = Kota::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama')
                        ->label('Nama Kota')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama Kota')
                        ->maxLength(255),
                    //choose country first and then province with dependant select
                    Select::make('provinsi_id')
                        ->label('Provinsi')
                        ->required()
                        ->placeholder('Pilih Provinsi')
                        ->options(
                            Provinsi::all()->pluck('nama', 'id')
                        )
                        ->searchable()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('provinsi.nama')
                    ->formatStateUsing(fn (string $state): string => __(ucfirst($state)))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')->since()
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
            'index' => Pages\ListKotas::route('/'),
            'create' => Pages\CreateKota::route('/create'),
            'edit' => Pages\EditKota::route('/{record}/edit'),
        ];
    }    
}
