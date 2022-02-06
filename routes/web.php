<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CoursesController;
use App\Http\Controllers\Frontend\CategoriesController;
use App\Http\Controllers\Frontend\BlogsController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [CoursesController::class, 'second'])->name('welcome');
Route::resource('frontend/course', CoursesController::class);
Route::resource('/layouts/header', CategoriesController::class);
Route::resource('frontend/blog', BlogsController::class);

Route::get('course_detail', function () {
    return view('course_detail');
});

Route::get('blog', function () {
    return view('blog');
});

Route::get('backend/index', function () {
    return view('backend/index');
});
Route::get('/admin', function () {
    return view('auth/login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth'],'name'=> 'admin'], function (){

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('course', CourseController::class);
    Route::resource('user', UserController::class);

    // Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    // Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    // Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    // Route::get('/category/edit/{parameter}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    // Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/course/{id}/delete', [CourseController::class, 'delete'])->name('admin.course.delete');
    Route::get('/blog/{id}/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');
    Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('admin.category.delete');

    // Route::put('/users/profile/update', [UserController::class, 'profileUpdate'])->name('users.profile.update');

    // Route::resource('/roles', RoleController::class);
    // Route::get('/roles/role_permission/{roleId}', [RoleController::class, 'rolePermission'])->name('roles.role_permission');
    // Route::post('/roles/role_permission/{roleId}', [RoleController::class, 'rolePermissionAssign'])->name('roles.role_permission_assign');


});
