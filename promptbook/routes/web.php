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
