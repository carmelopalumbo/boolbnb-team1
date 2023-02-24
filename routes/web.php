<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [GuestController::class, 'index']);

Route::get('/property/detail/{id}', [GuestController::class, 'show'])->name('propertydetail');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->group(function () {
        Route::resource('properties', PropertyController::class);
        Route::get('messages', [MessageController::class, 'index']);
        Route::get('sponsors', [SponsorController::class, 'index'])->name('sponsors');
        Route::get('stats', [StatController::class, 'index']);
        Route::get('mymessages', [MessageController::class, 'index'])->name('mymessages');
        Route::delete('mymessages/delete', [MessageController::class, 'delete'])->name('mymessages.delete');
    });

Route::post('messages', [MessageController::class, 'store'])->name('messages');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
