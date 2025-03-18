<?php
use App\Http\Controllers\FarmController;

Route::get('/', [FarmController::class, 'index'])->name('input');
Route::post('/store', [FarmController::class, 'store'])->name('store');
Route::get('/dashboard', [FarmController::class, 'dashboard'])->name('dashboard');
Route::get('/despesas', [FarmController::class, 'despesas'])->name('despesas');
Route::get('/contratados', [FarmController::class, 'contratados'])->name('contratados');
Route::get('/fazenda', [FarmController::class, 'fazenda'])->name('fazenda');
Route::post('/despesas/add', [FarmController::class, 'addExpense'])->name('addExpense');
Route::post('/despesas/category/add', [FarmController::class, 'addCategory'])->name('addCategory');
Route::post('/contratados/add', [FarmController::class, 'addEmployee'])->name('addEmployee');
