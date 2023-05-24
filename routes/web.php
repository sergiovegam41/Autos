<?php

use App\Http\Controllers\AddSopportController;
use App\Http\Controllers\Informacion;
use App\Http\Controllers\Preguntas;
use App\Http\Controllers\SopportController;
use App\Http\Controllers\ViewOrdersDetail;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Turnero;
use App\Http\Controllers\Wallet;
use App\Http\Controllers\whatsApp\WhatsAppController;

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
    return redirect('admin');
});

Route::get('admin/Turnero', [Turnero::class, 'index']);
Route::get('/Turnero', [Turnero::class, 'index']);

//Route::get('/test',function (){
//
////    dd( \App\Models\LastOrderNumber::orderBy('created_at', 'desc')->first()->order_number);
//
//});
//Route::get('admin/searchSopport', [SopportController::class, 'index']);
//Route::get('/searchSopport', [SopportController::class, 'index']);

Route::get('admin/searchSopport', 'App\Http\Controllers\SopportController@index')->name('searchSopport');
Route::get('/searchSopport', 'App\Http\Controllers\SopportController@index')->name('searchSopport');

Route::get('admin/AddSopport', [AddSopportController::class, 'index']);
Route::get('/AddSopport', [AddSopportController::class, 'index']);

Route::get('admin/AddExceptionSopport', [AddSopportController::class, 'exceptionForm']);
Route::get('/AddExceptionSopport', [AddSopportController::class, 'exceptionForm']);

Route::get('admin/AddExceptionSopportStore', [AddSopportController::class, 'exceptionSave']);
Route::get('/AddExceptionSopportStore', [AddSopportController::class, 'exceptionSave']);

Route::get('admin/UpdateAddSopport', [AddSopportController::class, 'store']);
Route::get('/UpdateAddSopport', [AddSopportController::class, 'store']);

Route::get('/OrderEditDetail', [ViewOrdersDetail::class, 'update']);
Route::get('admin/OrderEditDetail', [ViewOrdersDetail::class, 'update']);

Route::get('admin/ViewOrdersDetail', [ViewOrdersDetail::class, 'index']);
Route::get('/ViewOrdersDetail', [ViewOrdersDetail::class, 'index']);

Route::get('admin/Wallet',  [Wallet::class, 'index']);
Route::get('/Wallet',  [Wallet::class, 'index']);

Route::get('admin/Preguntas',  [Preguntas::class, 'index']);
Route::get('admin/recursos/Preguntas',  [Preguntas::class, 'index']);
Route::get('/Preguntas',  [Preguntas::class, 'index']);

Route::get('admin/Informacion',  [Informacion::class, 'index']);
Route::get('admin/recursos/Informacion',  [Informacion::class, 'index']);
Route::get('/Informacion',  [Informacion::class, 'index']);

Route::get('admin/TURNERO-SAVE', [Turnero::class, 'store']);
Route::get('/TURNERO-SAVE', [Turnero::class, 'store']);
Route::get('/simple_form', [\App\Http\Controllers\simpleFormController::class, '__invoke']);


Route::get('admin/Facturacion', \App\Http\Controllers\facturacion\FacturacionController::class);

Route::post('GuardarFacturacion/', \App\Http\Controllers\facturacion\GuardarFacturacionController::class);
//
//dd();
//if(CRUDBooster::isSuperadmin()){
    Route::get('admin', App\Http\Controllers\Dashboards\DahsboardsController::class);
    Route::get('email', function (){
       \Illuminate\Support\Facades\Mail::to("sergiovegam41@gmail.com")->send(new \App\Mail\sendEmail());
       return "yes";
    });



    Route::get('admin/BotWhatsAppManager', \App\Http\Controllers\whatsApp\BotWhatsAppManager::class);
    Route::get('BotWhatsAppManager', \App\Http\Controllers\whatsApp\BotWhatsAppManager::class);


    Route::get('admin/AdminBot', \App\Http\Controllers\whatsApp\AdminBot::class);
    Route::get('AdminBot', \App\Http\Controllers\whatsApp\AdminBot::class);
//}

Route::get('/admin/whatsApp',[WhatsAppController::class, 'index']);

Route::get('/whatsApp',[WhatsAppController::class, 'index']);
