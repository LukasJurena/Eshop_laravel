<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Zákazník')
                    ->relationship('customer', 'name') // Předpokládám, že máte vztah s modelem Customer
                    ->required(),

                Forms\Components\Select::make('product_id')
                    ->label('Produkt')
                    ->relationship('product', 'name') // Předpokládám, že máte vztah s modelem Product
                    ->required(),

                    Forms\Components\Select::make('rating')
                    ->label('Hodnocení')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->required(),                
                Forms\Components\Textarea::make('comment')
                    ->label('Komentář')
                    ->required(),
            ]);
    }
    

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('customer.name')
                ->label('Zákazník')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('product.name')
                ->label('Produkt')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('rating')
                ->label('Hodnocení')
                ->sortable(),

            Tables\Columns\TextColumn::make('comment')
                ->label('Komentář')
                ->limit(50), // Omezte zobrazení komentáře pro přehlednost
        ])
        ->filters([
            // Filtry pro zobrazení recenzí, např. podle produktu nebo zákazníka
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
