<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\VIPRegistration;
use App\Models\Attendees;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', VIPRegistration::class);

//Route::get('/email', function () {
//    return view('mail.verification-code',['attendee'=>Attendees::find(1)]);
//});
