<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\Bot\BotTelegramController;
use App\Http\Controllers\Bot\BotNewTelegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('telegram')->name('telegram.')->group(function () {
    Route::get('/token', [BotTelegramController::class, 'token'])->name('token');
    Route::post('/url_webhookk2', [BotNewTelegramController::class, 'handleWebhook'])->name('handleWebhook');
    Route::post('/url_webhookk', [BotTelegramController::class, 'url_webhook'])->name('url_webhook');
    Route::get('/set_webhook', [BotTelegramController::class, 'set_webhook'])->name('set_webhook');
    Route::get('/info_webhook', [BotTelegramController::class, 'info_webhook'])->name('info_webhook');
    Route::get('/get_update', [BotTelegramController::class, 'get_update'])->name('get_update');
    Route::get('/test_send', [BotTelegramController::class, 'test_send'])->name('test_send');

});


Route::get('/config_optimize', [ConfigController::class, 'config_optimize'])->name('config_optimize');


 