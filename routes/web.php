<?php

use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\TelUserController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [App\Http\Controllers\TelUserController::class,'index']);
Route::get('/loginlogin', function (){
    return view('Login.login');
});
Route::post('/logged', [App\Http\Controllers\TelUserController::class,'CheckUser']);
Route::get('/ConfirmUser', [App\Http\Controllers\TelUserController::class,'adminLTE']);
Route::get('/Deleted_Mobile_users', [App\Http\Controllers\TelUserController::class,'Deleted_Mobile_users']);
Route::get('/FilterUser', [App\Http\Controllers\TelUserController::class,'FilterUser']);
Route::post('/prs_search', [App\Http\Controllers\TelUserController::class,'prs_search'])->name('prs_search');
Route::post('/restore_user', [App\Http\Controllers\TelUserController::class,'restore_user'])->name('restore_user');
Route::post('/Update_mobile', [App\Http\Controllers\TelUserController::class,'Update_mobile'])->name('Update_mobile');
Route::delete('users/{id}', [App\Http\Controllers\TelUserController::class,'destroy'])->name('users.destroy');
Route::delete('ForceDeleteUser/{id}', [App\Http\Controllers\TelUserController::class,'destroyForce'])->name('users.ForceDeleteUser');
Route::get('/export-users',[App\Http\Controllers\TelUserController::class,'exportUsers'])->name('export-users');
Route::post('/file-import', [TelUserController::class, 'fileImport'])->name('file-import');
Route::get('/telegram', [TelUserController::class, 'telegram'])->name('telegram');
Route::get('/updated-activity', [TelegramBotController::class,'updatedActivity'])->name('updated-activity');
Route::get('/call_madeline', [TelegramBotController::class,'call_madeline']);
Route::get('/UserStastics', [App\Http\Controllers\TelUserController::class,'UserStastics']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
