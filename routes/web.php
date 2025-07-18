<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\NotificationsController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login')
    ]);
});

// Test route for verification page (remove in production)
Route::get('/test-verification', function () {
    // Set some test data in session
    session(['verification_code' => '1234']);
    session(['verification_email' => 'test@example.com']);
    
    return redirect()->route('verification.create');
})->name('test.verification');

// Test route for new password page (remove in production)
Route::get('/test-new-password', function () {
    return redirect()->route('password.reset', [
        'token' => 'test-token-123',
        'email' => 'test@example.com'
    ]);
})->name('test.new-password');

// Test route for success page (remove in production)
Route::get('/test-success', function () {
    return redirect()->route('success.create');
})->name('test.success');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')
->prefix('users')
->name('users.')
->group(function () {
    Route::get('/all', [UserController::class, 'index'])->name('all');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});

Route::middleware('auth')
    ->prefix('role-permission')
    ->name('role-permission.')
    ->group(function () {
        Route::get('/roles', [RolePermissionController::class, 'roles'])->name('roles');
        Route::get('/assign', [RolePermissionController::class, 'assign'])->name('assign');
        // Add other routes as needed
    });

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    })->name('settings.index');
});

require __DIR__.'/auth.php';
