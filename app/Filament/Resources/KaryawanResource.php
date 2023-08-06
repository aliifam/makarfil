<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

use App\Models\Provinsi;
use App\Models\Departemen;
use App\Models\Kota;
use App\Models\Negara;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama')
                        ->label('Nama')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama')
                        ->maxLength(255),
                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required()
                        ->autofocus()
                        ->placeholder('Nama Lengkap')
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->autofocus()
                        ->placeholder('alamat email')
                        ->email()
                        ->maxLength(255),
                    DatePicker::make('tanggal_bergabung')
                        ->label('Tanggal Bergabung')
                        ->required()
                        ->placeholder('Tanggal Bergabung'),
                    Select::make('departemen_id')
                        ->label('Departemen')
                        ->required()
                        ->placeholder('Pilih Departemen')
                        ->options(
                            Departemen::all()->pluck('name', 'id')
                        )
                        ->searchable(),
                    Textarea::make('alamat')
                        ->label('Alamat')
                        ->required()
                        ->autofocus()
                        ->placeholder('Alamat Lengkap')
                        ->minLength(10)
                        ->maxLength(255),

                    Select::make('negara_id')
                        ->label('Negara')
                        ->required()
                        ->placeholder('Pilih Negara')
                        ->options(
                            Negara::all()->pluck('nama', 'id')
                        )
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set) {
                            $set('provinsi_id', null);
                            $set('kota_id', null);
                        }),
                    Select::make('provinsi_id')
                        ->label('Provinsi')
                        ->required()
                        ->placeholder('Pilih Provinsi')
                        ->options(
                            function (callable $get){
                                $negara = Negara::find($get('negara_id'));
                                if (!$negara) {
                                    return [];
                                }
                                return $negara->provinsis()->pluck('nama', 'id');
                            }
                        )
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set) {
                            $set('kota_id', null);
                        }),
                    Select::make('kota_id')
                        ->label('Kota')
                        ->required()
                        ->placeholder('Pilih Kota')
                        ->options(
                            function (callable $get){
                                $provinsi = Provinsi::find($get('provinsi_id'));
                                if (!$provinsi) {
                                    return [];
                                }
                                return $provinsi->kotas()->pluck('nama', 'id');
                            }
                        )
                        ->searchable(),
                    //choose country first and then province with dependant select
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }    
}
