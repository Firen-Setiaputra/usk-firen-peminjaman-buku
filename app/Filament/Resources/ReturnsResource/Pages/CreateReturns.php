<?php

namespace App\Filament\Resources\ReturnsResource\Pages;

use App\Filament\Resources\ReturnsResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateReturns extends CreateRecord
{
    protected static string $resource = ReturnsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Dikembalikan')
        ->body('Pengembalian telah berhasil');
}
}
