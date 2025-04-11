<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;
use App\Livewire\Homepage;
use App\Livewire\Creationpage;
use App\Livewire\Viewpage;
use App\Livewire\Feedpage;
use App\Livewire\PromptDetails;

Route::get('/', function () {
    return redirect('/login');
});

// view routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('homepage', Homepage::class)->name('homepage');

    Route::get('creationpage', Creationpage::class)->name('prompts.create');

    Route::get('promptdetails/{prompt}', PromptDetails::class)->name('prompt.show');

    Route::get('viewpage', Viewpage::class)->name('prompts.view');

    Route::get('feedpage', Feedpage::class)->name('prompts.feed');
    
    Route::view('profile', 'profile')->name('profile');

    // results route
    Route::get('/search-prompts/results', [PromptController::class, 'searchByTitle'])->name('search.prompts.results');
});


// update routes
Route::middleware('auth')->group(function () {
    Route::prefix('prompts')->group(function () {
        Route::get('/edit/{id}', [Viewpage::class, 'edit'])->name('prompts.edit');

        Route::post('/store', [PromptController::class, 'store'])->name('prompts.store');

        Route::put('/update/{id}', [PromptController::class, 'update'])->name('prompts.update');
        
        Route::delete('/delete/{id}', [PromptController::class, 'destroy'])->name('prompt.destroy');   
    });
});

// test routes
Route::middleware('auth')->group(function () {
    Route::prefix('prompts')->group(function () {
        Route::get('/my-prompts', [PromptController::class, 'myPrompts']);
        Route::get('/all-prompts', [PromptController::class, 'allPrompts']);
        Route::get('/favorited-prompts', [PromptController::class, 'allFavoritedPrompts']);

        Route::post('/prompts/{prompt}/favorite', [PromptController::class, 'toggleFavorite'])->name('prompts.toggleFavorite');
        Route::post('/prompts/{prompt}/like', [PromptController::class, 'toggleLike'])->name('prompts.toggleLike');
        Route::delete('/prompts/{prompt}', [PromptController::class, 'destroy'])->name('prompts.destroy');
        Route::put('/prompts/{prompt}/toggle-publicity', [PromptController::class, 'togglePublicity'])->name('prompts.togglePublicity');

        Route::put('/{id}/toggle-publicity', [PromptController::class, 'togglePublicity']);
    });
});


require __DIR__ . '/auth.php';
