<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\ProjectControl\ProjectControlBoqController;
use App\Http\Controllers\ProjectControl\ProjectControlPlanController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
});

Route::get('/', [DashboardController::class, 'show'])->name('home');


Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get("/", 'index')->name('projects');
    Route::post("/", 'store')->name('projects.store');
    Route::put("/{id}", 'update')->name('projects.update');
    Route::delete("/{id}", 'destroy')->name('projects.destroy');
});

Route::prefix('/project-control')->group(function () {
    Route::controller(ProjectControlPlanController::class)->group(function () {
        Route::prefix('/plans')->group(function () {
            Route::get("/{boqId}", 'index')->name('plan.show');
            Route::post("/", 'store')->name('plan.store');
            Route::delete("/{id}", 'destroy')->name('plan.destroy');
        });
    });

    Route::controller(ProjectControlBoqController::class)->group(function () {
        Route::prefix('/boq')->group(function () {
            Route::get("/", 'index')->name('boq');
            Route::post('/', 'store')->name('boq.store');
            Route::delete("/{id}", 'destroy')->name('boq.destroy');
        });
    });

});
