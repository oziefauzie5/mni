<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Applikasi\AppController;
use App\Http\Controllers\Area\Wilayah;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Paket\Paket;
use App\Http\Controllers\Registrasi\Pelanggan;
use App\Http\Controllers\Sales\Sales;
use App\Http\Controllers\Teknisi\Teknisi;
use App\Http\Controllers\Transaksi\Invoice;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Whatsapp\WhatsappApi;
use App\Http\Controllers\Whatsapp\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('/');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => ['auth:web'], 'as' => 'admin.'], function () {

    Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware(['role:admin|NOC|STAF']);
    ##CRUD DATA USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware(['role:admin|STAF']);
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware(['role:admin|STAF']);
    Route::put('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware(['role:admin|STAF']);
    Route::delete('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete')->middleware(['role:admin|STAF']);




    Route::get('/teknisi', [Teknisi::class, 'index'])->name('teknisi.index')->middleware(['role:TEKNISI']);
    Route::get('/teknisi/list-aktivasi', [Teknisi::class, 'list_aktivasi'])->name('teknisi.list_aktivasi')->middleware(['role:TEKNISI']);
    Route::get('/teknisi/{id}/aktivasi', [Teknisi::class, 'aktivasi'])->name('teknisi.aktivasi')->middleware(['role:TEKNISI']);
    Route::post('/teknisi/{id}/job', [Teknisi::class, 'job'])->name('teknisi.job')->middleware(['role:TEKNISI']);
    Route::post('/teknisi/proses_aktivasi', [Teknisi::class, 'proses_aktivasi'])->name('teknisi.proses_aktivasi')->middleware(['role:TEKNISI']);

    Route::get('/sales', [Sales::class, 'index'])->name('sales.index')->middleware(['role:SALES']);
    Route::get('/sales/input', [Sales::class, 'input'])->name('sales.input')->middleware(['role:SALES']);
    Route::post('/sales/store', [Sales::class, 'store'])->name('sales.store')->middleware(['role:SALES']);
    Route::get('/sales/{id}/get-paket', [Pelanggan::class, 'getPaket'])->name('sales.getPaket')->middleware(['role:SALES']);


    Route::get('/invoice', [Invoice::class, 'unpaid'])->name('inv.unpaid')->middleware(['role:admin|STAF']);
    Route::delete('/invoice/{id}/delete-invoice', [Invoice::class, 'delete_inv'])->name('inv.delete_inv')->middleware(['role:admin|STAF']);

    Route::get('/wilayah', [Wilayah::class, 'index'])->name('wil.index')->middleware(['role:admin|NOC|STAF']);
    Route::post('/wilayah/store', [Wilayah::class, 'store'])->name('wil.store')->middleware(['role:admin|NOC|STAF']);
    Route::put('/wilayah/{id}/update', [Wilayah::class, 'update'])->name('wil.update')->middleware(['role:admin|NOC|STAF']);


    Route::get('/setting', [AppController::class, 'index'])->name('app.index')->middleware(['role:admin|STAF']);
    Route::post('/setting/app', [AppController::class, 'akun_store'])->name('app.akun_store')->middleware(['role:admin|STAF']);
    Route::put('/setting/{id}/app-akun-edit', [AppController::class, 'akun_edit'])->name('app.akun_edit')->middleware(['role:admin|STAF']);
    Route::delete('/setting/{id}/app-akun-delete', [AppController::class, 'akun_delete'])->name('app.akun_delete')->middleware(['role:admin|STAF']);
    Route::post('/setting/app-tripay', [AppController::class, 'tripay_store'])->name('app.tripay_store')->middleware(['role:admin|STAF']);
    Route::post('/setting/applikasi', [AppController::class, 'aplikasi_store'])->name('app.aplikasi_store')->middleware(['role:admin|STAF']);
    Route::post('/setting/app-biaya', [AppController::class, 'biaya_store'])->name('app.biaya_store')->middleware(['role:admin|STAF']);
    Route::post('/setting/app-waktu', [AppController::class, 'waktu_store'])->name('app.waktu_store')->middleware(['role:admin|STAF']);
    Route::post('/setting/app-whatsapp', [AppController::class, 'whatsapp_store'])->name('app.whatsapp_store')->middleware(['role:admin|STAF']);

    Route::get('/setting/paket', [Paket::class, 'paket'])->name('app.paket')->middleware(['role:admin|STAF']);
    Route::post('/setting/add-paket', [Paket::class, 'store'])->name('app.paket.store')->middleware(['role:admin|STAF']);
    Route::put('/setting/{id}/update-paket', [Paket::class, 'update'])->name('app.paket.update')->middleware(['role:admin|STAF']);
    Route::delete('/setting/{id}/delete-paket', [Paket::class, 'delete'])->name('app.paket.delete')->middleware(['role:admin|STAF']);

    Route::get('/registrasi/list', [Pelanggan::class, 'index'])->name('pel.index')->middleware(['role:admin|NOC|STAF']);
    Route::get('/registrasi/{id}/verif', [Pelanggan::class, 'verif'])->name('pel.verif')->middleware(['role:admin|NOC|STAF']);
    Route::put('/registrasi/proses-verif', [Pelanggan::class, 'proses_verif'])->name('pel.proses_verif')->middleware(['role:admin|NOC|STAF']);
    Route::put('/registrasi/{id}/aktivasi-noc', [Pelanggan::class, 'aktivasi_noc'])->name('pel.aktivasi_noc')->middleware(['role:admin|NOC|STAF']);
    Route::put('/registrasi/{id}/status', [Pelanggan::class, 'status'])->name('pel.status')->middleware(['role:admin|NOC|STAF']);
    Route::get('/registrasi/{id}/print', [Pelanggan::class, 'print'])->name('pel.print')->middleware(['role:admin|NOC|STAF']);
    Route::get('/registrasi', [Pelanggan::class, 'registrasi'])->name('pel.registrasi')->middleware(['role:admin|NOC|STAF']);
    Route::post('/registrasi/store', [Pelanggan::class, 'store'])->name('pel.store')->middleware(['role:admin|NOC|STAF']);
    Route::get('/registrasi/{id}/get-paket', [Pelanggan::class, 'getPaket'])->name('pel.getPaket')->middleware(['role:admin|NOC|STAF']);


    Route::get('/whatsapp/update-group', [WhatsappApi::class, 'update_group_list'])->name('whatsapp.update_group_list')->middleware(['role:admin|NOC|STAF']);
    Route::get('/whatsapp/send-message', [WhatsappApi::class, 'send_message'])->name('whatsapp.send_message')->middleware(['role:admin|NOC|STAF']);


    Route::get('/whatsapp/pesan', [WhatsappController::class, 'index'])->name('wa.index')->middleware(['role:admin|NOC|STAF']);
    Route::delete('/whatsapp/pesan-delete/{id}', [WhatsappController::class, 'delete_pesan'])->name('wa.delete_pesan')->middleware(['role:admin|NOC|STAF']);
})->middleware(['role:admin|SALES|NOC|STAF']);
