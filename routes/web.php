<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\VIPRegistration;
use App\Livewire\CheckIn;
use App\Livewire\Register;
use App\Models\Attendees;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', Register::class);
Route::get('/register/{enc_id?}', Register::class)->name('register');

Route::get('/vip-register', VIPRegistration::class);
Route::get('/vip-register/{enc_id?}', VIPRegistration::class)->name('vip-register');
Route::get('/check-in-code/{enc_id?}', CheckIn::class)->name('check-in');

Route::get('/check-in/{enc_id?}', function ($enc_id = null) {
    return view('check-in-landing', ['enc_id' => $enc_id]);
});


Route::get('/check-in', function () {
    return view('check-in-landing');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

//Route::get('/email', function () {
//    return view('mail.verification-code',['attendee'=>Attendees::find(1)]);
//});
