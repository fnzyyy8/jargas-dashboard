<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectControlPlanController;
use App\Http\Controllers\ProjectControlBoqController;

Route::get('/', [DashboardController::class, 'show'])->name('home');


Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get("/", 'index')->name('projects');
    Route::post("/", 'store')->name('projects.store');
    Route::put("/{id}", 'update')->name('projects.update');
    Route::delete("/{id}", 'destroy')->name('projects.destroy');
});

Route::prefix('/project-control')->group(function () {
    Route::controller(ProjectControlPlanController::class)->group(function () {
        Route::get("/plan", 'index')->name('plan');
        Route::post("/plan", 'store')->name('plan.store');
    });

    Route::controller(ProjectControlBoqController::class)->group(function () {
        Route::prefix('/boq')->group(function () {
            Route::get("/", 'index')->name('boq');
            Route::post('/', 'store')->name('boq.store');
            Route::delete("/{id}", 'destroy')->name('boq.destroy');
        });
    });
});
