<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Livewire\Dashboard;


Route::view('/', 'welcome');


Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/testing', function () {
    return view('create-prompt-test-page');
});

Route::view('/testing-prompt-retrieval', 'testing-prompt-retrieval');
    
Route::post('/prompts', [PromptController::class, 'store'])->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
});

require __DIR__ . '/auth.php';