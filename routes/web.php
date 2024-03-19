<?php

use App\Http\Controllers\FootballController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [FootballController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/clubs', [FootballController::class, 'viewClub'])->name('football.clubs.index');
    Route::get('/clubs/create', [FootballController::class, 'createClub'])->name('football.clubs.create');
    Route::post('/clubs/create', [FootballController::class, 'storeClub'])->name('football.clubs.store');

    Route::get('/matches', [FootballController::class, 'viewMatches'])->name('football.matches.index');
    Route::get('/matches/create', [FootballController::class, 'createMatches'])->name('football.matches.create');
    Route::post('/matches/create', [FootballController::class, 'storeMatches'])->name('football.matches.store');

});

require __DIR__.'/auth.php';
