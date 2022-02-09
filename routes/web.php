<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\MethodsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
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
});

Route::middleware(['auth', 'admin'])->group(function (){
    // GET
    Route::get('/admin/settings', [SettingsController::class, 'render'])->name('admin.settings');
    Route::get('/admin/users', [UsersController::class, 'render'])->name('admin.users');
    Route::get('/admin/methods', [MethodsController::class, 'render'])->name('admin.methods');
    Route::get('/admin/cache', [CacheController::class, 'render'])->name('admin.cache');

    // POST
    Route::post('/admin/settings', [SettingsController::class, 'post'])->name('admin.settings');
    Route::post('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
    Route::post('/admin/users/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/methods/create', [MethodsController::class, 'create'])->name('admin.methods.create');
    Route::post('/admin/methods/delete', [MethodsController::class, 'delete'])->name('admin.methods.delete');
    Route::post('/admin/cache/flush', [CacheController::class, 'flush'])->name('admin.cache.flush');
});

require __DIR__.'/auth.php';
