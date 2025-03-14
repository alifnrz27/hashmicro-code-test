<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CharacterMatch\CharacterMatchController;
use App\Http\Controllers\Score\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('scores.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'insertNewUser'])->name('insertNewUser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/character-match', [CharacterMatchController::class, 'index'])->name('character.match');
Route::post('/character-match', [CharacterMatchController::class, 'check'])->name('character.match.check');

Route::resource('scores', ScoreController::class);