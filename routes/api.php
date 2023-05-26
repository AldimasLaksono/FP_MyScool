<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; //panggil AuthController
use App\Http\Controllers\Admin\JabatanController; //panggil JabatanController
use App\Http\Controllers\Admin\MapelController; //panggil MapelController
use App\Http\Controllers\Admin\GedungController; //panggil GedungController
use App\Http\Controllers\Admin\RuangController; //panggil RuangController
use App\Http\Controllers\Admin\GuruController; //panggil RuangController

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

Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['admin.api'])->prefix('admin')->group(function(){
    //Route CRUD Data Jabatan
    Route::post('create-jabatan',[JabatanController::class,'create_jabatan']);
    Route::post('suting-jabatan/{id_tmja}',[JabatanController::class,'update_jabatan']);
    Route::delete('delete-jabatan/{id_tmja}',[JabatanController::class,'delete_jabatan']);
    Route::get('show-jabatan',[JabatanController::class,'show_jabatan']);

    //Route CRUD Data Mapel
    Route::post('create-mapel',[MapelController::class,'create_mapel']);
    Route::post('suting-mapel/{id_tmm}',[MapelController::class,'update_mapel']);
    Route::delete('delete-mapel/{id_tmm}',[MapelController::class,'delete_mapel']);
    Route::get('show-mapel',[MapelController::class,'show_mapel']);

    //Route CRUD Data Gedung
    Route::post('create-gedung',[GedungController::class,'create_gedung']);
    Route::post('suting-gedung/{id_tmge}',[GedungController::class,'update_gedung']);
    Route::delete('delete-gedung/{id_tmge}',[GedungController::class,'delete_gedung']);
    Route::get('show-gedung',[GedungController::class,'show_gedung']);

    //Route CRUD Data Ruang
    Route::post('create-ruang',[RuangController::class,'create_ruang']);
    Route::post('suting-ruang/{id_tmr}',[RuangController::class,'update_ruang']);
    Route::delete('delete-ruang/{id_tmr}',[RuangController::class,'delete_ruang']);
    Route::get('show-ruang',[RuangController::class,'show_ruang']);

    Route::post('create-guru',[GuruController::class,'create_guru']);
    Route::post('suting-guru/{id_tmg}',[GuruController::class,'update_guru']);
    Route::delete('delete-guru/{id_tmg}',[GuruController::class,'delete_guru']);
    Route::get('show-guru',[GuruController::class,'show_guru']);
});