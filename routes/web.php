<?php

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

Route::group(['prefix' => 'admin'], function () {

    Route::post('/v1/get_by_list/{table_name}', [ApiGeneralController::class, 'getTableDataByTableName'])->name('admin.v1.get_by_list');

});
