<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');