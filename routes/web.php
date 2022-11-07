<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\EditorsController;
use App\Http\Controllers\Admin\EstatusNotasController;
use App\Http\Controllers\Admin\NotasController as AdminNotasController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\SuscriptorsController;
use App\Http\Controllers\Admin\VideogalleriesController;
use App\Http\Controllers\EditoresController;
use App\Http\Controllers\MigracionController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SUDO\AsignPermissionsController;
use App\Http\Controllers\SUDO\PermissionsController;
use App\Http\Controllers\SUDO\RolesController;
use App\Http\Controllers\TesteandoController;
use App\Http\Controllers\WebviewController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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
 /*
if($_SERVER['REMOTE_ADDR'] != '189.242.5.154'){
    Route::get('/', [WebviewController::class, 'mantenimiento'])->name('mantenimiento');
}else {
    
Route::get('/', [WebviewController::class, 'welcome'])->name('welcome');
*/
Route::get('guest', function () {
    return view('welcome');
});
/*
    $targetFolder = storage_path().'/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    echo " De " . $linkFolder . '<br>';
    echo " a " . $targetFolder;

    symlink($targetFolder,$linkFolder);
    echo 'Symlink process successfully completed';
    */ //echo $targetFolder; 
/*
Route::get('storage-link', function("{
    Artisan::call('storage:link');
});


Route::get('clear-views', function(){
    Artisan::call('view:clear');
});

Route::get('clear-permisions', function(){
    app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
});
*/

Route::get('storage-link', function(){
    Artisan::call('storage:link');
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $roles = Auth::user()->roles()->get();
    
    if($roles[0]->name == 'Suscriptor')
        return redirect()->route('admin.suscriptores.index');
    return view('dashboard');
})->name('dashboard');

Route::resource('notas', NotasController::class)
->only(['index','show','editores','categorias','reaction', 'share', 'save', 'nosave','coments'])
    ->names('notas');


Route::resource('editores', EditoresController::class)
    ->only(['show'])
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
Route::get("web.terms", [WebviewController::class, 'terms'])->name('web.terms');



// Rutas para admin y sudo que deben verificar login 
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('estatusnotas', EstatusNotasController::class)->names('admin.notas.estatus');
    Route::resource('editorprofile', ProfileController::class)->names('admin.editor.profile');
    // rutas para administracion de notas 
    Route::resource('adminnotas', AdminNotasController::class)
        ->names('admin.notas');
    Route::get('adminnotaschangestatus', [AdminNotasController::class, 'change_status'])->name('admin.notas.change_status');
    //Administracion de categorias
    Route::resource('admincategories', CategoriesController::class)
        ->only('index', 'create', 'store', 'update', 'edit')
        ->names('admin.categorias');

    //Administracion de editores
    Route::resource('admineditors', EditorsController::class)
        ->names('admin.editors');

    //Rutas para el sudo
    Route::resource('sudoroles', RolesController::class)->names("sudo.roles");
    Route::resource('sudopermissions', PermissionsController::class)->names("sudo.permissions");
    Route::resource('sudoasignpermissions', AsignPermissionsController::class)->names('sudo.asign.permissions');

    // Rutas para admin estadisticas
    Route::resource('adminstatistics', StatisticsController::class)->names('admin.estadisticas');
    Route::get('adminstatisticsmasleidas/{start}/{end}', [StatisticsController::class, 'masleidas'])->name('admin.estadisticas.masleidas');

    // Rutas para admin estadisticas
    Route::resource('videogalleries', VideogalleriesController::class)->names('admin.videogalerias');

    Route::resource('suscriptors', SuscriptorsController::class)->names('admin.suscriptores');
    Route::get('suscriptorssaved', [SuscriptorsController::class, 'saved'])->name('admin.suscriptores.guardadas');
    Route::get('suscriptorsconfig', [SuscriptorsController::class, 'config'])->name('admin.suscriptores.config');
    Route::post('suscriptorssuscribeto', [SuscriptorsController::class, 'suscribeto'])->name('admin.suscriptores.suscribeto');
    Route::get('suscriptorspassword', [SuscriptorsController::class, 'password'])->name('admin.suscriptores.password');

    // Rutas para admin comentarios
    Route::resource('admincoments', CommentsController::class)->names('admin.comentarios');

    // Rutas para admin configuraciones
    Route::resource('adminconfigs', ConfigsController::class)->only('index', 'store')->names('admin.configuraciones');

    // Rutas para admin anuncios
    Route::resource('adminads', AdsController::class)->names('admin.anuncios');
});


//rutas
Route::get('routes', function () {
    $routeCollection = Route::getRoutes();
    foreach ($routeCollection as $value) {
        if ($value->getName() != '') {
            $existe = Permission::where('name', $value->getName())->first();
            if (!$existe)
                Permission::create(['name' => $value->getName()]);
        }
        //echo $value->methods()[0] . "-----";
        //echo $value->uri() . "-----";
        //echo $value->getName() . "-----";
        //echo $value->getActionName() . "-----<br>";
    }

    return redirect()->route('sudo.permissions.index');
});

//borrar cache de permisos
Route::get('clear-cache-permisos', function () {
    app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    exit('ñ_ñ');
});

Route::resource('migracion', MigracionController::class)->names('migracion');
Route::get('migracion_csv', [MigracionController::class, 'read_csv'])->name('migracion_csv');

//probando ogin con FB
Route::get('auth/facebook', [SocialController::class, 'redirectFacebook']);
Route::get('auth/facebook/callback', [SocialController::class, 'callbackFacebook']);

//crontab para publicar en fb
Route::get('crontab_fb', [ServicesController::class, 'crontab_fb'])->name('crontab_fb');


Route::get('/testfb', [TesteandoController::class, 'testfb'])->name('testfb');

//} cierre de condicional si se limita a una ip