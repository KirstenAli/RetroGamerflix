<?php

use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;
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

// named routes
Route::middleware(['auth'])->prefix('/game')->group(function () {
    Route::get('/all', [GameController::class, 'getAll']);
    Route::get('/favorites', [GameController::class, 'getFavorites']);
    Route::get('/recentlyPlayed', [GameController::class, 'getRecentlyPlayed']);
    Route::put('/addFavorite/{game}', [GameController::class, 'addFavorite']);
    Route::delete('/removeFavorite/{game}', [GameController::class, 'removeFavorite']);
    Route::put('/addRecentlyPlayed/{game}', [GameController::class, 'addRecentlyPlayed']);
    Route::delete('/removeRecentlyPlayed/{game}', [GameController::class, 'removeRecentlyPlayed']);
    Route::get('/rom/{fileName}', [GameController::class, 'getRom']);
    Route::get('/contain/{str}', [GameController::class, 'getAllGamesContain']);
    Route::get('/thumbnail/{fileName}', [GameController::class, 'getThumbnail']);
    Route::get('/index', [GameController::class, 'index'])->name('index');
    Route::get('/playGame/{game}', [GameController::class, 'playGame']);
    Route::get('/welcomeAudio', [GameController::class, 'welcomeAudio']);
});

Route::middleware(['auth', 'admin'])->prefix('/admin/game')->group(function () {
    Route::get('/adminPanel', [AdminGameController::class, 'adminPanel']);
    Route::post('/store', [AdminGameController::class, 'store']);
    Route::post('/update', [AdminGameController::class, 'update']);
    Route::delete('/destroy/{game}', [AdminGameController::class, 'destroy']);
    Route::get('/genres', [AdminGameController::class, 'getGenres']);
});

Route::get('/logo', [GameController::class, 'logo']);
Route::get('/mainBanner', [GameController::class, 'mainBanner']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
