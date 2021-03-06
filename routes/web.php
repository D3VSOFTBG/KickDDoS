<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\MethodsController;
use App\Http\Controllers\Admin\ServersController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TestController;

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

// GET
Route::get('/', [HomeController::class, 'render'])->name('home');

Route::middleware(['auth'])->group(function (){
    // GET
    Route::get('/user/test', [TestController::class, 'render'])->name('user.test');
    Route::get('/user/profile', [ProfileController::class, 'render'])->name('user.profile');

    // POST
    Route::post('/user/profile', [ProfileController::class, 'post'])->name('user.profile');
    Route::post('/user/test', [TestController::class, 'post'])->name('user.test');
});

Route::middleware(['auth', 'admin'])->group(function (){
    // GET
    Route::get('/admin/settings', [SettingsController::class, 'render'])->name('admin.settings');
    Route::get('/admin/users', [UsersController::class, 'render'])->name('admin.users');
    Route::get('/admin/methods', [MethodsController::class, 'render'])->name('admin.methods');
    Route::get('/admin/cache', [CacheController::class, 'render'])->name('admin.cache');
    Route::get('/admin/servers', [ServersController::class, 'render'])->name('admin.servers');

    // POST
    Route::post('/admin/settings', [SettingsController::class, 'post'])->name('admin.settings');
    Route::post('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
    Route::post('/admin/users/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/methods/create', [MethodsController::class, 'create'])->name('admin.methods.create');
    Route::post('/admin/methods/delete', [MethodsController::class, 'delete'])->name('admin.methods.delete');
    Route::post('/admin/cache/flush', [CacheController::class, 'flush'])->name('admin.cache.flush');
    Route::post('/admin/servers/create', [ServersController::class, 'create'])->name('admin.servers.create');
    Route::post('/admin/servers/delete', [ServersController::class, 'delete'])->name('admin.servers.delete');
});

Route::middleware(['install'])->group(function ()
{
    // GET
    Route::get('/install', [InstallController::class, 'install_get'])->name('install');
    Route::get('/install/1', [InstallController::class, 'install_1_get'])->name('install.1');
    Route::get('/install/2', [InstallController::class, 'install_2_get'])->name('install.2');
    Route::get('/install/3', [InstallController::class, 'install_3_get'])->name('install.3');

    // POST
    Route::post('/install/1', [InstallController::class, 'install_1_post'])->name('install.1');
    Route::post('/install/2', [InstallController::class, 'install_2_post'])->name('install.2');
    Route::post('/install/3', [InstallController::class, 'install_3_post'])->name('install.3');
});

require __DIR__.'/auth.php';
