<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Middleware\AdminAccessMiddleware;
use App\Http\Controllers\API\LkController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SimpleActionController;
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
   Route::post('register',[LoginController::class,'register']);

   Route::get('logout',[LoginController::class,'logout']);
   Route::get('action/{number}',[SimpleActionController::class,'reception']);
   Route::post('fireBase',[UserController::class,'fireBaseAddToken']);
   Route::get('fireBaseGetMessage',[\App\Http\Controllers\TScontroller::class,'index']);


   Route::prefix('admin')->middleware(AdminAccessMiddleware::class)->group(function(){
      Route::get('getRoles',[AdminController::class,'getRoles']);
      Route::get('getActions',[AdminController::class,'getActions']);
      Route::get('getUsersList',[AdminController::class,'getUsersList']);
      Route::get('getPermissions',[AdminController::class,'getPermissions']);
      Route::post('dropUserPassword',[AdminController::class,'dropUserPassword']);
      Route::post('deleteUser',[AdminController::class,'deleteUser']);
      Route::post('removeUserRole',[AdminController::class,'removeUserRole']);
      Route::post('addUserRole',[AdminController::class,'addUserRole']);
      Route::post('newRoleAdd',[AdminController::class,'newRoleAdd']);
      Route::post('addAction',[AdminController::class,'addAction']);
      Route::delete('deleteRole',[AdminController::class,'deleteRole']);
      Route::delete('deleteAction',[AdminController::class,'deleteAction']);
      Route::put('changePermissions',[AdminController::class,'changePermissions']);
   });
   Route::prefix('user')->group(function(){
      Route::post('changePassword',[UserController::class,'changePassword']);
      Route::put('updateContacts',[UserController::class,'updateContacts']);
   });

});
