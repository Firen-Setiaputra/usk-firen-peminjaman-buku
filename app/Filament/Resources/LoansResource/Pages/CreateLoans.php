<?php

namespace App\Filament\Resources\LoansResource\Pages;

use App\Filament\Resources\LoansResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLoans extends CreateRecord
{
    protected static string $resource = LoansResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
    ->color('info') // Warna biru
        ->title('Dipinjam')
        ->body('Buku telah berhasil di pinjam');
}
}
