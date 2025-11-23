<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoulMirrorController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('game.start');
});

// Routes สำหรับ AI Soul Mirror
Route::get('/soul-mirror', [SoulMirrorController::class, 'index'])->name('soul.index');
Route::post('/soul-mirror/analyze', [SoulMirrorController::class, 'analyze'])->name('soul.analyze');

// Game Routes
Route::get('/game/start', [GameController::class, 'start'])->name('game.start');
Route::get('/game/intro', [GameController::class, 'intro'])->name('game.intro');
Route::get('/game/begin', [GameController::class, 'begin'])->name('game.begin');
Route::get('/game/play/{id}', [GameController::class, 'play'])->name('game.play');
Route::post('/game/submit/{id}', [GameController::class, 'submit'])->name('game.submit');
Route::get('/game/loading', [GameController::class, 'loading'])->name('game.loading');
Route::get('/game/analyze', [GameController::class, 'analyze'])->name('game.analyze');
Route::get('/game/error', [GameController::class, 'error'])->name('game.error');
