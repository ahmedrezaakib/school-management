<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControll;

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/login', [AdminControll::class, 'index'])->name('admin.login');
Route::get('admin/dashboard', [AdminControll::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/form', [AdminControll::class, 'form'])->name('admin.form');
Route::get('admin/table', [AdminControll::class, 'table'])->name('admin.table');

