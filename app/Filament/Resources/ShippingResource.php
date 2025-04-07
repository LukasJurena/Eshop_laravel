<?php

namespace App\Filament\Resources;

use App\Models\Shipping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\NumberInput;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck'; // ikona pro dopravu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->step(0.01),
                TextArea::make('description')
                    ->nullable()
                    ->maxLength(500),
                Toggle::make('is_active')
                    ->label('Aktivní')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\BooleanColumn::make('is_active')->label('Aktivní'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ShippingResource\Pages\ListShippings::route('/'),
            'create' => \App\Filament\Resources\ShippingResource\Pages\CreateShipping::route('/create'),
            'edit' => \App\Filament\Resources\ShippingResource\Pages\EditShipping::route('/{record}/edit'),
        ];
    }
}