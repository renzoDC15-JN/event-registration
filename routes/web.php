<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\VIPRegistration;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', VIPRegistration::class);
