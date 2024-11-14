<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/testing', function () {
    return view('create-prompt-test-page');
});
    
Route::post('/prompts', [PromptController::class, 'store'])->middleware(['auth']);

require __DIR__ . '/auth.php';