<?php

use Illuminate\Http\Request;

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

// Kelas Anggota
Route::get('/kelas_anggota/check/anggota','KelasAnggotaController@checkAnggota');
Route::post('/kelas_anggota','KelasAnggotaController@store');

// Kelas
Route::get('/kelas','KelasController@all');
Route::get('/kelas/{id}','KelasController@show');
Route::get('/kelas/search/query','KelasController@search');
Route::post('/kelas','KelasController@store');
Route::put('kelas/{id}','KelasController@update');
Route::delete('kelas/{id}','KelasController@delete');

// Materi
Route::get('/materi/{id}','MateriController@show');
Route::post('/materi','MateriController@store');
Route::put('/materi/{id}','MateriController@update');
Route::delete('/materi/{id}','MateriController@delete');

// Pengajar
Route::get('/pengajar','PengajarController@all');
Route::get('/pengajar/{id}','PengajarController@show');
Route::post('/pengajar','PengajarController@store');
Route::post('/pengajar/login','PengajarController@login');
Route::put('/pengajar/{id}','PengajarController@update');
Route::put('/pengajar/{id}/saldo/add','PengajarController@addSaldo');
Route::put('/pengajar/{id}/saldo/min','PengajarController@minSaldo');
Route::delete('/pengajar/{id}','PengajarController@delete');

// Siswa
Route::get('/siswa','SiswaController@all');
Route::get('/siswa/{id}','SiswaController@show');
Route::post('/siswa','SiswaController@store');
Route::post('/siswa/login','SiswaController@login');
Route::put('/siswa/{id}','SiswaController@update');
Route::put('/siswa/{id}/saldo/add','SiswaController@addSaldo');
Route::put('/siswa/{id}/saldo/min','SiswaController@minSaldo');
Route::delete('/siswa/{id}','SiswaController@delete');
