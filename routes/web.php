<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['role::admin']], function () {
    // Route::get('wedding-packages', [WeddingPackageController::class]);
}); 

Route::group(['middleware' => ['role' => 'user']], function () {
    // Route::get('wedding-packages/{id}', [WeddingPackageController::class, 'show']);
    // Route::post('wedding-packages/book', [WeddingPackageController::class, 'book']);
});

require __DIR__.'/auth.php';
