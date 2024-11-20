<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Livewire\Dashboard;

use App\Livewire\Homepage;
use App\Livewire\Creationpage;
use App\Livewire\Viewpage;
use App\Livewire\Feedpage;




// view routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('homepage', Homepage::class)->name('homepage');
    Route::get('creationpage', Creationpage::class)->name('prompts.create');
    Route::get('viewpage', Viewpage::class)->name('prompts.view');
    Route::get('feedpage', Feedpage::class)->name('prompts.feed');
    Route::view('profile', 'profile')->name('profile');
});


// update routes
Route::middleware('auth')->group(function () {
    Route::post('/prompts', [PromptController::class, 'store'])->name('prompts.store');
    Route::put('/prompts/{id}', [PromptController::class, 'update'])->middleware('auth')->name('prompts.update');
    Route::delete('/prompts/{id}', [PromptController::class, 'destroy'])->middleware('auth');
    
    Route::post('/prompts/{id}/like', [PromptController::class, 'toggleLike']);
    Route::post('/prompts/{id}/save', [PromptController::class, 'toggleFavorite']);
});


// test routes
Route::middleware('auth')->group(function () {
    Route::get('/prompts/my-prompts', [PromptController::class, 'myPrompts']);
    Route::get('/prompts/all-prompts', [PromptController::class, 'allPrompts']);
    Route::put('/prompts/{id}/toggle-publicity', [PromptController::class, 'togglePublicity'])->middleware(['auth']);
});


// testing routes 
Route::view('/testing-prompt-retrieval', 'testing-prompt-retrieval');
    




require __DIR__ . '/auth.php';
