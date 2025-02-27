<?php

namespace App\Filament\Resources\ReturnsResource\Pages;

use App\Filament\Resources\ReturnsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReturns extends ListRecords
{
    protected static string $resource = ReturnsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
