<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
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

    Route::get('/prompts/edit/{id}', [Viewpage::class, 'edit'])->name('prompts.edit');


    // results route
    Route::prefix('search-prompts')->group(function () {
        Route::get('/results', [PromptController::class, 'searchByTitle'])->name('search.prompts.results');
    });
});


// update routes
Route::middleware('auth')->group(function () {
    Route::prefix('prompts')->group(function () {
        Route::post('/store', [PromptController::class, 'store'])->name('prompts.store');
        Route::put('/update/{id}', [PromptController::class, 'update'])->name('prompts.update');
        Route::delete('/delete/{id}', [PromptController::class, 'destroy'])->name('prompt.destroy');   
    });
});


require __DIR__ . '/auth.php';
