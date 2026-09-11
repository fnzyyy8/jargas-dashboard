<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\ProjectControl\BoqController;
use App\Http\Controllers\ProjectControl\PlanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProjectControl\PlanDetailController;
use App\Http\Controllers\ProjectControl\ItemDetailController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
});

Route::get('/', [DashboardController::class, 'show'])->name('home');


Route::controller(ProjectController::class)->prefix('/projects')->group(function () {
    Route::get("/", 'index')->name('projects');
    Route::post("/", 'create')->name('projects.create');
    Route::put("/{id}", 'update')->name('projects.update');
    Route::delete("/{id}", 'delete')->name('projects.delete');
});

Route::prefix('/project-control')->group(function () {

    Route::controller(ItemDetailController::class)->prefix('/item-details')->group(function () {
        Route::get("/", 'index')->name('item-details.index');
        Route::post("/", 'create')->name('item-details.create');
        Route::put("/{id}", 'update')->name('item-details.update');
        Route::delete("/{id}", 'delete')->name('item-details.delete');
    });

    Route::controller(BoqController::class)->prefix('/boq')->group(function () {
        Route::get("/", 'index')->name('boq');
        Route::post("/", 'create')->name('boq.create');
        Route::put("/{id}", 'update')->name('boq.update');
        Route::delete("/{id}", 'delete')->name('boq.delete');

        Route::controller(PlanController::class)->prefix('/{boqId}/plan')->name('plan.')->group(function () {
            Route::get("/", 'index')->name('index');
            Route::post("/", 'create')->name('create');
            Route::delete("/{id}", 'delete')->name('delete');

            Route::controller(PlanDetailController::class)->prefix('/{planId}/detail')->name('detail.')->group(function () {
                Route::get("/", 'index')->name('index');
                Route::post("/", 'create')->name('create');
            });
        });
    });
});


