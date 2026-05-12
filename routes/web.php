<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PublicVehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicVehicleController::class, 'index'])->name('vehicles.index');
Route::get('/unit/{vehicle:slug}', [PublicVehicleController::class, 'show'])->name('vehicles.show');
Route::post('/unit/{vehicle:slug}/inquiry', [LeadController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('vehicles.inquiry');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::get('/dashboard', function () {
    return redirect()->route('vehicles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
