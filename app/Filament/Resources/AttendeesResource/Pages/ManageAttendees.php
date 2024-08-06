<?php

namespace App\Filament\Resources\AttendeesResource\Pages;

use App\Filament\Resources\AttendeesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAttendees extends ManageRecords
{
    protected static string $resource = AttendeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
