<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CharacterMatch\CharacterMatchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'insertNewUser'])->name('insertNewUser');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/character-match', [CharacterMatchController::class, 'index'])->name('character.match');
Route::post('/character-match', [CharacterMatchController::class, 'check'])->name('character.match.check');