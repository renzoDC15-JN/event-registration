<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueTables extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'description','capacity'];
    protected $casts=[
        'capacity'=>'integer'
    ];
}
