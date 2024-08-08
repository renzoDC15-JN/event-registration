<?php

namespace App\Filament\Imports;

use App\Models\Attendees;
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
                ->rules(['required', 'email', 'max:255']),
            ImportColumn::make('mobile')
                ->rules(['max:255']),
            ImportColumn::make('job_title')
                ->rules(['max:255']),
            ImportColumn::make('company_name')
                ->rules(['max:255']),
            ImportColumn::make('attendee_code')
                ->rules(['max:255']),
            ImportColumn::make('status_code')
                ->rules(['max:255']),
            ImportColumn::make('pre_listed')
                ->boolean()
                ->rules(['boolean']),
        ];
    }

    public function resolveRecord(): ?Attendees
    {
        // return Attendees::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Attendees();
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
