<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GpoaActivityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Activity Management
    Route::get('/submit-activity', [ActivityController::class, 'create'])->name('user.submit');
    Route::post('/store-activity', [ActivityController::class, 'store'])->name('user.store');
    Route::get('/my-activities', [ActivityController::class, 'index'])->name('user.activities');

    // GPOA Activity Submission
    Route::get('/gpoa/create', [GpoaActivityController::class, 'create'])->name('gpoa.create');
    Route::post('/gpoa/store', [GpoaActivityController::class, 'store'])->name('gpoa.store');

    // Profile management (Breeze)
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Only Routes
    Route::middleware([\App\Http\Middleware\AdminMiddlerware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/activities', [AdminController::class, 'monitor'])->name('activities');
        Route::get('/approve/{id}', [AdminController::class, 'approve'])->name('approve');
        Route::get('/reject/{id}', [AdminController::class, 'reject'])->name('reject');
        Route::get('/activities/export/{format}', [AdminController::class, 'exportActivities'])->name('activities.export');

        // user management
        Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [\App\Http\Controllers\AdminUserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('users.destroy');
    });
});