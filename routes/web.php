<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EstatusNotasController;
use App\Http\Controllers\Admin\NotasController as AdminNotasController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\EditoresController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WebviewController;
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
    Route::get('notas.category.{category}', [NotasController::class, 'categorias'])->name('notas.categorias');
    Route::post('notas.like', [NotasController::class, 'like'])->name('notas.like');
    Route::post('notas.slike', [NotasController::class, 'slike'])->name('notas.slike');
    Route::post('notas.nolike', [NotasController::class, 'nolike'])->name('notas.nolike');
    Route::post('notas.share', [NotasController::class, 'share'])->name('notas.share');
    Route::post('notas.save', [NotasController::class, 'save'])->name('notas.save');


    Route::get('notas.admin', [NotasController::class, 'admin'])->name('notas.admin');

    // rutas para administracion de notas 
    Route::resource('adminnotas', AdminNotasController::class)
    ->names('admin.notas');

    Route::resource('admincategories', CategoriesController::class)
    ->names('admin.categorias');

Route::resource('estatusnotas', EstatusNotasController::class)->names('admin.notas.estatus');
Route::resource('editorprofile', ProfileController::class)->names('admin.editor.profile');
//Rutas de servicios para autocompletes
Route::get('services/related', [ServicesController::class, 'related'])->name('services.related');
Route::get('services/search', [ServicesController::class, 'posts'])->name('services.posts');

//vistas publicas
Route::resource('web.view', WebviewController::class)->only('vagabundario')->names('web');
Route::get('vagabundario', [WebviewController::class, 'vagabundario'])->name('web.vagabundario');
Route::get('entrevistas', [WebviewController::class, 'entrevistas'])->name('web.entrevistas');
Route::get('reportajes', [WebviewController::class, 'reportajes'])->name('web.reportajes');
Route::get('noticias', [WebviewController::class, 'noticias'])->name('web.noticias');
//Route::get('entrevistas.{section}', [WebviewController::class, 'entrevista'])->name('web.entrevistas');

Route::get("web.aboutus", [WebviewController::class, 'aboutus'])->name('web.aboutus');
Route::get("web.privacy", [WebviewController::class, 'privacy'])->name('web.privacy');
Route::get("web.team", [WebviewController::class, 'team'])->name('web.team');