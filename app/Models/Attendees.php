<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Status;
use App\Models\Events;
use App\Models\VenueTables;

class Attendees extends Model
{
    use Notifiable;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_code',
        'status_code',
        'pre_listed',
        'attendee_code',
        'table_code',
        'first_name',
        'last_name',
        'full_name',
        'company_name',
        'job_title',
        'email',
        'mobile',
    ];

    protected $casts = [
        'pre_listed'=>'boolean',
    ];

    public function routeNotificationForEngageSpark()
    {
        return $this->mobile;
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_code', 'code');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_code', 'code');
    }

    public function venueTable()
    {
        return $this->belongsTo(VenueTables::class, 'table_code', 'code');
    }

    public function generateUniqueCode():void
    {
        do {
            // Generate a random letter (A-Z)
            $letter = chr(rand(65, 90)); // 65 is ASCII for 'A' and 90 is ASCII for 'Z'

            // Generate a random three-digit number
            $number = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

            // Combine the letter and number
            $generated_code = $letter . $number;

            // Check if the code already exists
            $exists = self::where('attendee_code', $generated_code)->exists();
        } while ($exists); // Repeat until a unique code is found

        // Update the attendee_code for the current instance
        $this->attendee_code = $generated_code;
        $this->save();
    }
}
