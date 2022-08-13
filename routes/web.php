<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EditorsController;
use App\Http\Controllers\Admin\EstatusNotasController;
use App\Http\Controllers\Admin\NotasController as AdminNotasController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\EditoresController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SUDO\AsignPermissionsController;
use App\Http\Controllers\SUDO\PermissionsController;
use App\Http\Controllers\SUDO\RolesController;
use App\Http\Controllers\WebviewController;
use Illuminate\Support\Facades\Artisan;
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


Route::get('/', [WebviewController::class, 'welcome'])->name('welcome');
Route::get('guest', function () {
    return view('welcome');
});
    $targetFolder = storage_path().'/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    //echo " De " . $linkFolder . '<br>';
    //echo " a " . $targetFolder;

    symlink($targetFolder,$linkFolder);
    echo 'Symlink process successfully completed';
    //echo $targetFolder; 
/*
Route::get('storage-link', function("{
    Artisan::call('storage:link');
});
*/
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('notas', NotasController::class)
    ->names('notas');


Route::resource('editores', EditoresController::class)
    ->names('editores');

Route::get('notas.editores.{nota}', [NotasController::class, 'editores'])->name('notas.editores');
Route::get('notas.category.{category}', [NotasController::class, 'categorias'])->name('notas.categorias');
Route::post('notas.reaction', [NotasController::class, 'reaction'])->name('notas.reaction');
Route::post('notas.like', [NotasController::class, 'like'])->name('notas.like');
Route::post('notas.slike', [NotasController::class, 'slike'])->name('notas.slike');
Route::post('notas.nolike', [NotasController::class, 'nolike'])->name('notas.nolike');
Route::post('notas.share', [NotasController::class, 'share'])->name('notas.share');
Route::post('notas.save', [NotasController::class, 'save'])->name('notas.save');
Route::post('notas.nosave', [NotasController::class, 'nosave'])->name('notas.nosave');
Route::post('notas.coments', [NotasController::class, 'coments'])->name('notas.coments');


Route::get('notas.admin', [NotasController::class, 'admin'])->name('notas.admin');

// rutas para administracion de notas 
Route::resource('adminnotas', AdminNotasController::class)
    ->names('admin.notas');
//Administracion de categorias
Route::resource('admincategories', CategoriesController::class)
    ->names('admin.categorias');

//Administracion de editores
Route::resource('admineditors', EditorsController::class)
    ->names('admin.editors');

Route::resource('estatusnotas', EstatusNotasController::class)->names('admin.notas.estatus');
Route::resource('editorprofile', ProfileController::class)->names('admin.editor.profile');
//Rutas de servicios para autocompletes
Route::get('services/related', [ServicesController::class, 'related'])->name('services.related');
Route::get('services/search', [ServicesController::class, 'posts'])->name('services.posts');
Route::get('services/data', [ServicesController::class, 'data'])->name('services.data');
Route::get('services/popup_images', [ServicesController::class, 'popup_images'])->name('services.popup_images');

Route::post('services/imagen_upload', [ServicesController::class, 'imagen_upload'])->name('services.imagen_upload');
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

//Rutas para el sudo
Route::resource('sudoroles', RolesController::class)->names("sudo.roles");
Route::resource('sudopermissions', PermissionsController::class)->names("sudo.permissions");
Route::resource('sudoasignpermissions', AsignPermissionsController::class)->names('sudo.asign.permissions');
