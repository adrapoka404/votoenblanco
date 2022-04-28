<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EstatusNotasController;
use App\Http\Controllers\Admin\NotasController as AdminNotasController;
use App\Http\Controllers\EditoresController;
use App\Http\Controllers\NotasController;
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
Route::get('guest', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('notas', NotasController::class)
    ->names('notas');


    Route::resource('editores', EditoresController::class)
    ->names('editores');

    Route::get('notas.editores.{nota}', [NotasController::class, 'editores'])->name('notas.editores');

    Route::get('notas.admin', [NotasController::class, 'admin'])->name('notas.admin');

    // rutas para administracion de notas 
    Route::resource('adminnotas', AdminNotasController::class)
    ->names('admin.notas');

    Route::resource('admincategories', CategoriesController::class)
    ->names('admin.categorias');

Route::resource('estatusnotas', EstatusNotasController::class)->names('admin.notas.estatus');