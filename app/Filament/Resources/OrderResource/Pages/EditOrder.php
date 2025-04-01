<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $updatedRecord = parent::handleRecordUpdate($record, $data);

        // Pokud byla objednávka potvrzena, pošleme e-mail
        if ($data['status'] === 'confirmed') {
            Mail::to($record->email)->send(new OrderConfirmed($record));
        }

        return $updatedRecord;
    }
}
