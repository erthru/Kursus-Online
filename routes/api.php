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

// Pengguna
Route::get('/pengguna','PenggunaController@all');
Route::get('/pengguna/{id}','PenggunaController@show');
Route::post('/pengguna','PenggunaController@store');
Route::post('/pengguna/login','PenggunaController@login');
Route::put('/pengguna/{id}','PenggunaController@update');
Route::put('/pengguna/{id}/saldo/add','PenggunaController@addSaldo');
Route::put('/pengguna/{id}/saldo/min','PenggunaController@minSaldo');
Route::delete('/pengguna/{id}','PenggunaController@delete');
