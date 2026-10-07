<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcurementRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


// ==========================================
// AUTHENTICATION ROUTES
// ==========================================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);


// ==========================================
// PROTECTED ROUTES
// ==========================================

Route::middleware('auth')->group(function () {

    // ======================================
    // DASHBOARD
    // ======================================

    Route::get('/', [ProcurementRequestController::class, 'index']);


    // ======================================
    // ADMIN-ONLY ROUTES
    // ======================================

    Route::middleware('admin')->group(function () {

        // ==================================
        // PROCUREMENT REQUESTS
        // ==================================

        Route::get('/procurement-requests/create',
            [ProcurementRequestController::class, 'create']);

        Route::post('/procurement-requests',
            [ProcurementRequestController::class, 'store']);

        Route::get('/procurement-requests/{procurementRequest}/edit',
            [ProcurementRequestController::class, 'edit'])
            ->name('procurement-requests.edit');

        Route::put('/procurement-requests/{procurementRequest}',
            [ProcurementRequestController::class, 'update'])
            ->name('procurement-requests.update');

        Route::delete('/procurement-requests/{procurementRequest}',
            [ProcurementRequestController::class, 'destroy'])
            ->name('procurement-requests.destroy');


        // ==================================
        // USER MANAGEMENT
        // ==================================

        // View Users
        Route::get('/users',
            [UserController::class, 'index'])
            ->name('users.index');

        // Add User
        Route::get('/users/create',
            [UserController::class, 'create'])
            ->name('users.create');

        // Save User
        Route::post('/users',
            [UserController::class, 'store'])
            ->name('users.store');

        // Edit User
        Route::get('/users/{user}/edit',
            [UserController::class, 'edit'])
            ->name('users.edit');

        // Update User
        Route::put('/users/{user}',
            [UserController::class, 'update'])
            ->name('users.update');

            Route::delete('/users/{user}',
    [UserController::class, 'destroy'])
    ->name('users.destroy');
    });


    // ======================================
    // VIEW PROCUREMENT REQUEST
    // ======================================

    Route::get('/procurement-requests/{procurementRequest}',
        [ProcurementRequestController::class, 'show'])
        ->name('procurement-requests.show');

});