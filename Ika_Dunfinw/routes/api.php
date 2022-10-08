<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VerifyEmailController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[ClientController::class, 'login']);
Route::post('register',[ClientController::class, 'register']);

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend link to verify email
Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::middleware('auth:api')->group(function () {
    Route::get('user',[ClientController::class, 'index']);
    Route::post('logout',[ClientController::class, 'logout']);
    Route::post('photo',[ClientController::class, 'photoUser']);
    Route::post('commande', [CommandeController::class, 'commande']);
    Route::get('afficher/{idRes}', [CommandeController::class, 'afficher']);
    Route::get('affichage', [CommandeController::class, 'affichage']);
    Route::post('adresse', [CommandeController::class, 'adresse']);
    Route::get('message', [MessageController::class, 'message']);
});

Route::get('restaurant', [RestaurantController::class, 'restaurant']);
Route::get('menus/{id}', [MenuController::class, 'menus']);
Route::get('categorie/{id}/{url}', [MenuController::class, 'selectMenus']);


Route::get('restaurant', [RestaurantController::class, 'restaurant']);
Route::get('menus/{id}', [MenuController::class, 'menus']);
Route::get('categorie/{id}/{url}', [MenuController::class, 'selectMenus']);