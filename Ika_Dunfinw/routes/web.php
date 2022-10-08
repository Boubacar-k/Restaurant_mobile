<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Menus;
use App\Http\Livewire\Users;
use App\Http\Livewire\Commandes;
use App\Http\Livewire\Livreurs;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/menu', Menus::class)->name('menu');
    Route::get('/user', Users::class)->name('user');
    Route::get('/livreur', Livreurs::class)->name('livreur');
    Route::get('/commande', Commandes::class)->name('commande');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/gerant', [HomeController::class, 'redirect'])->name('gerant');
});
