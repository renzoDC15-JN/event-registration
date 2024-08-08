<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\VIPRegistration;
use App\Livewire\CheckIn;
use App\Models\Attendees;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vip-register', VIPRegistration::class);
Route::get('/check-in-code', CheckIn::class);

Route::get('/check-in', function () {
    return view('check-in-landing');
});

//Route::get('/email', function () {
//    return view('mail.verification-code',['attendee'=>Attendees::find(1)]);
//});
