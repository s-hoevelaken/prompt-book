<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Homepage;
use App\Http\Controllers\PromptController;
use App\Livewire\Dashboard;


Route::view('/', 'welcome');


Route::get('homepage', Homepage::class)
    ->middleware(['auth', 'verified'])
    ->name('homepage');



Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/testing', function () {
    return view('create-prompt-test-page');
});

Route::put('/prompts/{id}/toggle-publicity', [PromptController::class, 'togglePublicity'])->middleware(['auth']);

Route::view('/testing-prompt-retrieval', 'testing-prompt-retrieval');
    
Route::post('/prompts', [PromptController::class, 'store'])->middleware('auth');

Route::delete('/prompts/{id}', [PromptController::class, 'destroy'])->middleware('auth');

Route::put('/prompts/{id}', [PromptController::class, 'update'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
    Route::post('/prompts/{id}/like', [PromptController::class, 'toggleLike']);
    Route::post('/prompts/{id}/save', [PromptController::class, 'toggleFavorite']);
});

require __DIR__ . '/auth.php';
