<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contact', [ContactController::class, 'store'])->name('add-contact');
Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('delete-contact');
Route::patch('/contact/{contact}', [ContactController::class, 'update'])->name('update-contact');
