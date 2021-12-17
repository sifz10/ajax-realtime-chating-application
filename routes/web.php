<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  MessageController,
};
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('sent', [MessageController::class, 'create'])->name('sent');
Route::get('messages', [MessageController::class, 'read'])->name('read');


require __DIR__.'/auth.php';
