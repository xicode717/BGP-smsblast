<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterClientController;
use App\Http\Controllers\SMSBlastController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserDeviceController;

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
Route::post('/master-client/hapus', [App\Http\Controllers\MasterClientController::class, 'hapus'])->name('hapus');
Route::resource('/smsblast', SMSBlastController::class);
Route::get('/send/sendsmsview', [App\Http\Controllers\SMSBlastController::class, 'sendsmsview'])->name('sendsmsview');
// Route::post('/smsblast/resend/{phone}', [App\Http\Controllers\SMSBlastController::class, 'resend'])->name('resend');
Route::post('/smsblast/resend', [App\Http\Controllers\SMSBlastController::class, 'resend'])->name('resend');
Route::resource('/users', UsersController::class);
Route::resource('/userdevices', UserDeviceController::class);

// Datatables Server Side
Route::get('/datatables/smsblast', [App\Http\Controllers\SMSBlastController::class, 'serverside'])->name('serverside');
Route::get('/datatables/master-client', [App\Http\Controllers\MasterClientController::class, 'serverside'])->name('serverside');
Route::get('/datatables/userdevices', [App\Http\Controllers\UserDeviceController::class, 'serverside'])->name('serverside');
// end Datatables Server Side

Route::get('/logout', function(){
    \Auth::logout();
    return redirect('/home');
});
