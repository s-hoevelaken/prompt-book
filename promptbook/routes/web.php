<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Livewire\Dashboard;
use App\Livewire\Homepage;
use App\Livewire\Creationpage;
use App\Livewire\Viewpage;
use App\Livewire\Feedpage;

Route::view('/', 'welcome');

// view routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('homepage', Homepage::class)->name('homepage');
    Route::get('creationpage', Creationpage::class)->name('prompts.create');
    Route::get('viewpage', Viewpage::class)->name('prompts.view');
    Route::get('feedpage', Feedpage::class)->name('prompts.feed');
    Route::view('profile', 'profile')->name('profile');
});


// search routes
Route::view('/search-prompts', 'search-prompts')->middleware('auth')->name('search.prompts.view');
Route::get('/search-prompts-results', [PromptController::class, 'searchByTitle'])->middleware('auth')->name('search.prompts.results');

// update routes
Route::middleware('auth')->group(function () {
    Route::post('/prompts', [PromptController::class, 'store'])->name('prompts.store');
    Route::put('/prompts/{id}', [PromptController::class, 'update'])->name('prompts.update');
    Route::delete('/prompts/{id}', [PromptController::class, 'destroy'])->name('prompts.destroy');
    
    Route::post('/prompts/{id}/like', [PromptController::class, 'toggleLike'])->name('prompts.toggleLike');
    Route::post('/prompts/{id}/save', [PromptController::class, 'toggleFavorite']);
});


// test routes
Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
    Route::put('/prompts/{id}/toggle-publicity', [PromptController::class, 'togglePublicity']);
});


// testing routes 
Route::view('/testing-prompt-retrieval', 'testing-prompt-retrieval');
    



Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/favorited-prompts', [PromptController::class, 'allFavoritedPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
    Route::post('/prompts/{id}/save', [PromptController::class, 'toggleFavorite']);
});

require __DIR__ . '/auth.php';
