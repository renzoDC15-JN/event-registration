<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'first_name',
        'last_name',
        'email',
        'mobile',
        'job_title',
        'company_name',
        'attendee_code',
        'status_code',
        'pre_listed',
    ];

    protected $casts = [
        'pre_listed'=>'boolean',
    ];

    public function routeNotificationForEngageSpark()
    {
        return $this->mobile;
    }
}
