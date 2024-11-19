<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Livewire\Dashboard;

use App\Livewire\Homepage;
use App\Livewire\Creationpage;
use App\Livewire\Viewpage;
use App\Livewire\Feedpage;


// view routes
Route::get('homepage', Homepage::class)->middleware(['auth', 'verified'])->name('homepage');
Route::get('creationpage', Creationpage::class)->middleware(['auth'])->name('prompts.create');
Route::get('viewpage', Viewpage::class)->middleware(['auth'])->name('prompts.view');
Route::get('feedpage', Feedpage::class)->middleware(['auth'])->name('prompts.feed');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');


// testing routes 
Route::put('/prompts/{id}/toggle-publicity', [PromptController::class, 'togglePublicity'])->middleware(['auth']);
Route::view('/testing-prompt-retrieval', 'testing-prompt-retrieval');
    
Route::post('/prompts', [PromptController::class, 'store'])
->middleware('auth')
->name('prompts.store');

Route::delete('/prompts/{id}', [PromptController::class, 'destroy'])->middleware('auth');

Route::put('/prompts/{id}', [PromptController::class, 'update'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
    Route::post('/prompts/{id}/like', [PromptController::class, 'toggleLike']);
    Route::post('/prompts/{id}/save', [PromptController::class, 'toggleFavorite']);
});

require __DIR__ . '/auth.php';
