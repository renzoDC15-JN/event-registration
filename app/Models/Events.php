<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendees;
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


    public function getEncRouteAttribute()
    {
        return route('vip-register', Crypt::encrypt($this->id));
    }
}
