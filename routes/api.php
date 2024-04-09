<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Middleware\AdminAccessMiddleware;
use App\Http\Controllers\API\LkController;
use App\Http\Controllers\API\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function(){
   Route::post('login',[LoginController::class,'login']);
   Route::post('logout',[LoginController::class,'logout']);
   Route::post('register',[LoginController::class,'register']);
   Route::post('changePassword',[LoginController::class,'changePassword']);
   Route::get('action',[LkController::class,'index']);
   Route::post('FireBase',[UserController::class,'fireBaseAddToken']);

   Route::prefix('admin')->middleware(AdminAccessMiddleware::class)->group(function(){
      Route::get('getRoles',[AdminController::class,'getRoles']);
      Route::get('getUsersList',[AdminController::class,'getUsersList']);
      Route::post('dropUserPassword',[AdminController::class,'dropUserPassword']);
      Route::post('deleteUser',[AdminController::class,'deleteUser']);
      Route::post('removeUserRole',[AdminController::class,'removeUserRole']);
      Route::post('addUserRole',[AdminController::class,'addUserRole']);
      Route::post('newRoleAdd',[AdminController::class,'newRoleAdd']);
      Route::post('deleteRole',[AdminController::class,'deleteRole']);
      Route::get('getPermissions',[AdminController::class,'getPermissions']);
      Route::put('changePermissions',[AdminController::class,'changePermissions']);
      Route::get('getActions',[AdminController::class,'getActions']);
      Route::post('deleteAction',[AdminController::class,'deleteAction']);
      Route::post('addAction',[AdminController::class,'addAction']);
   });
   Route::prefix('user')->group(function(){
      Route::post('changePassword',[UserController::class,'changePassword']);
      Route::post('updateContacts',[UserController::class,'updateContacts']);
   });

});
