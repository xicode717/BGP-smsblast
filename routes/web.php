<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterClientController;
use App\Http\Controllers\SMSBlastController;
use App\Http\Controllers\UsersController;

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

// Route::get('/', function () {
//     return view('admin.home');
// });
// Route::resource('home', HomeController::class);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/master-client', MasterClientController::class);
Route::resource('/smsblast', SMSBlastController::class);
Route::get('/send/sendsmsview', [App\Http\Controllers\SMSBlastController::class, 'sendsmsview'])->name('sendsmsview');
Route::post('/smsblast/resend/{phone}', [App\Http\Controllers\SMSBlastController::class, 'resend'])->name('resend');
Route::resource('/users', UsersController::class);

Route::get('/logout', function(){
    \Auth::logout();
    return redirect('/home');
});
