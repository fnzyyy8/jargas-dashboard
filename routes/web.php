<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\ProjectController;

Route::get('/', [DashboardController::class, 'show'])->name('home');


Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get("/", 'index')->name('projects');
    Route::post("/", 'store')->name('projects.store');
    Route::put("/{id}", 'update')->name('projects.update');
    Route::delete("/{id}", 'destroy')->name('projects.destroy');

});

