<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsTable extends Model
{
    use HasFactory;
    protected $fillable = [
         'event_code',
         'description',
         'capacity'
        ];
    protected $casts=[
        'capacity'=>'integer'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_code', 'code');
    }

    public function attendees()
    {
        return $this->event->attendees()->where('table_code', $this->description)->get();
    }

    public function availableCapacity(): int
    {
        // Count the number of attendees assigned to this table
        $attendeeCount = $this->attendees()->count();

        // Calculate the available capacity
        $availableCapacity = $this->capacity - $attendeeCount;

        // Ensure the available capacity is not less than zero
        return max(0, $availableCapacity);
    }
}
