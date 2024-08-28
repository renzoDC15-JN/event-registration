<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendees;
use App\Models\EventsTable;
use Illuminate\Support\Facades\Crypt;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'url',
        'qr_code',
        'options',
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function attendees()
    {
        return $this->hasMany(Attendees::class, 'event_code', 'code');
    }


    public function eventTables()
    {
        return $this->hasMany(EventsTable::class, 'event_code', 'code');
    }


    public function getEncRouteAttribute()
    {
        return route('vip-register', Crypt::encrypt($this->id));
    }

    public function getAvailableTable():string
    {
        foreach ($this->eventTables as $table) {
            if ($table->availableCapacity() > 0) {
                return $table->description;
            }
        }

        return 'kindly proceed to registration area'; // No available table found
    }

    public function getAllAvailableTables()
    {
        $availableTables = [];

        foreach ($this->eventTables as $table) {
            if ($table->availableCapacity() > 0) {
                $availableTables[] = $table;
            }
        }

        return $availableTables;
    }
}
