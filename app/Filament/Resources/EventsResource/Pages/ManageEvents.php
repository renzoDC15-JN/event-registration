<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Crypt;
use App\Models\Events;

class ManageEvents extends ManageRecords
{
    protected static string $resource = EventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data, string $model): Events {
                    $event =Events::create($data);
                    $event->update([
                        'url' => route('vip-register', ['enc_id' => Crypt::encrypt($event->id)])
                    ]);

                    return  $event;
                }),
        ];
    }
}
