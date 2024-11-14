<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Homepage;

Route::view('/', 'welcome');


Route::get('homepage', Homepage::class)
    ->middleware(['auth', 'verified'])
    ->name('homepage');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
