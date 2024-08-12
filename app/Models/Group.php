<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendees;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'description'];

    public function attendees()
    {
        return $this->hasMany(Attendees::class, 'group_code', 'code');
    }
}
