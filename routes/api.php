<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//-->test work server
Route::get('hello', fn() => '------> LARAVEL 9 X');

//-->connect auth controller register
Route::post('register', [AuthController::class, 'register']);
//-->connect auth controller login
Route::post('login', [AuthController::class, 'login']);
//-->get user
//check token middleware
Route::middleware('auth:sanctum')->group(function(){
    //main user and Logout
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    //update user info and Password
    Route::put('users/info', [AuthController::class, 'updateInfo']);
    Route::put('users/password', [AuthController::class, 'updatePassword']);
    //permissions
    Route::get('permissions', [PermissionController::class, 'index']);
    //roles
    Route::apiResource('roles', RoleController::class);
    //products
    Route::apiResource('products', ProductController::class);
    //upload product image
    Route::post('upload', [ImageController::class, 'upload']);
    //orders
    //Route::post('orders', [OrderController::class, 'index']);
    //Route::post('orders/{id}', [OrderController::class, 'show']);
    //compact api
    Route::apiResource('orders', OrderController::class);
//    Route::get('roles', [RoleController::class, 'index']);
//    //roles with show permissions
//    Route::get('roles/{id}', [RoleController::class, 'show']);
    //users - use apiResources in UserController
    Route::apiResource('users', UserController::class);
    //api resources include all method route-
//    Route::get('users', [UserController::class, 'index']);
//    Route::post('users', [UserController::class, 'store']);
//    Route::get('users/{id}', [UserController::class, 'show']);
//    Route::put('users/{id}', [UserController::class, 'update']);
//    Route::delete('users/{id}', [UserController::class, 'destroy']);

});


