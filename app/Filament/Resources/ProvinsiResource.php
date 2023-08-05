<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinsiResource\Pages;
use App\Filament\Resources\ProvinsiResource\RelationManagers;
use App\Models\Negara;
use App\Models\Provinsi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama')
                        ->label('Nama Provinsi')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama Provinsi')
                        ->maxLength(255),
                    Select::make('negara_id')
                        ->label('Negara')
                        ->required()
                        ->placeholder('Pilih Negara')
                        ->options(
                            Negara::all()->pluck('nama', 'id')
                        )
                        ->searchable(),
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
                TextColumn::make('negara.nama')
                    ->formatStateUsing(fn (string $state): string => __(ucfirst($state)))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('negara_id')
                    ->select(
                        Negara::all()->pluck('nama', 'id')
                    )
                    ->label('Negara')
                    ->nullable()
                    ->default(null),
            ],
            layout:Layout::AboveContent,
            )
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
            'index' => Pages\ListProvinsis::route('/'),
            'create' => Pages\CreateProvinsi::route('/create'),
            'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }    
}
