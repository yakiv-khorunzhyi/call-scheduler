<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('call.create'))->name('call.create');
Route::get('calls', [\App\Http\Controllers\CallController::class, 'index'])->name('call.list');
Route::post('calls', [\App\Http\Controllers\CallController::class, 'store'])->name('call.store');
