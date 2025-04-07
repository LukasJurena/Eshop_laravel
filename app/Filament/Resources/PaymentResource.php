<?php

namespace App\Filament\Resources;

use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\PaymentResource\Pages;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;
class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('payment_method')->required(),
                TextInput::make('amount')->numeric()->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('confirmPayment')
                ->label('Potvrdit platbu')
                ->color('success')
                ->icon('heroicon-o-check')
                ->action(function (Payment $record) {
                    $record->update(['status' => 'completed']);

                    // Odeslat e-mail zákazníkovi
                    Mail::to($record->user->email)->send(new OrderConfirmed($record));
                })
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
    
}