<?php

namespace App\Filament\Resources\VenueTablesResource\Pages;

use App\Filament\Resources\VenueTablesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVenueTables extends ManageRecords
{
    protected static string $resource = VenueTablesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
