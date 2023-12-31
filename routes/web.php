<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PairController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\BotTable;
use App\Http\Livewire\UserCreate;
use App\Http\Livewire\UserTable;
use App\Http\Middleware\IsAdmin;
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
    if(Auth::check()) {
        return redirect()->route('search');
    }
    return view('welcome');
})->name('welcome');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/create-admin', [LoginController::class, 'createAdmin'])->name('createAdmin');

Route::middleware('auth')->group(function () {

    Route::get('/wyloguj', [LoginController::class, 'logout'])->name('logout');

    Route::get('/szukaj', function () {
        return view('app.search');
    })->name('search');
    
    Route::get('/pary/{pair?}', [PairController::class, 'view'])->name('matches');

    Route::get('/files/{file}', [FileController::class, 'show'])->name('file');

    Route::get('/dd', [UserController::class, 'dump']);
});


Route::middleware(IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () { return view('layouts.admin'); });
    
    Route::get('/users', UserTable::class)->name('users');

    Route::get('/bots', BotTable::class)->name('bots');

});


