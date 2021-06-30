<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\lists;
use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', [lists::class, 'getList'])->middleware(['auth'])->name('dashboard');
Route::get('/list/{listid}/card/{cardid}', [CardController::class, 'detail']);
Route::post('/create/list', [lists::class, 'create']);
Route::post('/create/card', [CardController::class, 'create']);
Route::post('/update/card', [CardController::class, 'updateCard']);
Route::post('/delete/card', [CardController::class, 'deleteCard']);
Route::post('/delete/attachment', [CardController::class, 'deleteAttachment']);


Route::post('/newUser', [lists::class, 'newUser'])
    ->middleware('auth');

require __DIR__ . '/auth.php';
