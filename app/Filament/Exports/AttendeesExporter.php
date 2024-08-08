<?php

namespace App\Filament\Exports;

use App\Models\Attendees;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AttendeesExporter extends Exporter
{
    protected static ?string $model = Attendees::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('event.description'),
            ExportColumn::make('status.description'),
            ExportColumn::make('pre_listed'),
            ExportColumn::make('attendee_code'),
            ExportColumn::make('venueTable.description'),
            ExportColumn::make('first_name'),
            ExportColumn::make('last_name'),
            ExportColumn::make('company_name'),
            ExportColumn::make('job_title'),
            ExportColumn::make('email'),
            ExportColumn::make('mobile'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your attendees export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
