<?php

use App\Http\Controllers\FuncionarioController;
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
Route::get('/', [FuncionarioController::class, 'index']);
Route::post('/store', [FuncionarioController::class, 'store'])->name('store');
Route::get('/puxar', [FuncionarioController::class, 'puxar'])->name('puxar');
Route::get('/editar', [FuncionarioController::class, 'editar'])->name('editar');
Route::post('/atualizar', [FuncionarioController::class, 'atualizar'])->name('atualizar');
Route::post('/deletar', [FuncionarioController::class, 'deletar'])->name('deletar');

