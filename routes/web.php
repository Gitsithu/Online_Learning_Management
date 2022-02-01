<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;

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

Route::get('index', function () {
    return view('index');
});

Route::get('about', function () {
    return view('about');
});

Route::get('course', function () {
    return view('course');
});

Route::get('course_detail', function () {
    return view('course_detail');
});

Route::get('blog', function () {
    return view('blog');
});

Route::get('backend/index', function () {
    return view('backend/index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function (){


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('category', CategoryController::class);

    // Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    // Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    // Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    // Route::get('/category/edit/{parameter}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    // Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    // Route::post('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Route::put('/users/profile/update', [UserController::class, 'profileUpdate'])->name('users.profile.update');

    // Route::resource('/roles', RoleController::class);
    // Route::get('/roles/role_permission/{roleId}', [RoleController::class, 'rolePermission'])->name('roles.role_permission');
    // Route::post('/roles/role_permission/{roleId}', [RoleController::class, 'rolePermissionAssign'])->name('roles.role_permission_assign');


});
