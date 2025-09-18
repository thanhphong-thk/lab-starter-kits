<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('roles', [RoleController::class , 'index'])->name('roles.index');
    Route::post('roles/create', [RoleController::class , 'create'])->name('roles.create');
    Route::post('roles/update/{id}', [RoleController::class , 'update'])->name('roles.update');
    Route::delete('roles/delete/{id}', [RoleController::class , 'destroy'])->name('roles.destroy');



});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
