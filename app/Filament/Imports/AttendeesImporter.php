<?php

namespace App\Filament\Imports;

use App\Models\Attendees;
use App\Models\Status;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AttendeesImporter extends Importer
{
    protected static ?string $model = Attendees::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('first_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('last_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('email')
                ->requiredMapping()
                ->rules([ 'email', 'max:255']),
            ImportColumn::make('mobile')
                ->guess(['mobile','Phone number'])
                ->rules(['numeric','digits:10']),
            ImportColumn::make('job_title')
                ->rules(['max:255']),
            ImportColumn::make('company_name')
                ->rules(['required','max:255']),

        ];
    }

    public function resolveRecord(): ?Attendees
    {
        $attendee = Attendees::updateOrCreate(
            [
                'first_name' => $this->data['first_name'],
                'last_name' => $this->data['last_name'],
            ], // Attributes to find the record
           $this->data   // Attributes to update or set for the new record
        );

        $attendee->generateUniqueCode();

        $attendee->pre_listed=true;
        $attendee->status_code = Status::where('description','like','Registered')->first()->code;
        //update status to registered

        $attendee->save();

        return $attendee;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your attendees import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
