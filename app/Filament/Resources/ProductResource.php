<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Produkty';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Kategorie')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),

                TextArea::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(1000),

                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->helperText('Enter the product price'),

                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(255),

                TextInput::make('in_stock')
                    ->label('In Stock')
                    ->required(),

                FileUpload::make('images')
                    ->label('Product Images')
                    ->image()
                    ->directory('gallery')
                    ->maxSize(5120)
                    ->multiple()
                    ->helperText('Upload one or more images for the product gallery')
                    ->disk('public')
                    ->columnSpan('full')
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('images', $state); // Uloží cesty do JSON pole v modelu
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Product Name'),
                Tables\Columns\TextColumn::make('price')->label('Price')->money('usd'),
                Tables\Columns\TextColumn::make('sku')->label('SKU'),
                Tables\Columns\BooleanColumn::make('in_stock')->label('In Stock')->trueColor('success')->falseColor('danger'),
                Tables\Columns\TextColumn::make('category.name')->label('Kategorie'), // 👈 zobrazíme název kategorie
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('in_stock')
                    ->options([
                        '1' => 'In Stock',
                        '0' => 'Out of Stock',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
