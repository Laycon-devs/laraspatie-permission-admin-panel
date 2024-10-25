<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use Illuminate\Routing\RouteGroup;
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

Route::group(['middleware' => 'isAdmin'], function () {

    Route::get('/', function () {
        return view('home');
    })->name('login');

    Route::resource('permission', permissionController::class);
    Route::get('permission/{permissionId}/delete', [permissionController::class, 'destroy']);

    Route::resource('role', roleController::class);
    Route::get('role/{roleId}/delete', [roleController::class, 'destroy']);
    Route::get('role/{roleId}/add-permission-role', [roleController::class, 'addPermissionRole']);
    Route::put('role/{roleId}/add-permission-role', [roleController::class, 'updatePermissionRole']);

    Route::resource('users', userController::class);
    Route::get('users/{userId}/delete', [userController::class, 'destroy']);
});

// Route::get('login', function(){
//     return view('login');
// })->name('login');

Route::group(['middleware' => ['guest_with_intended']], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
