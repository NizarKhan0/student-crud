<?php

use App\Livewire\EditStudent;
use App\Livewire\ListStudents;
use App\Livewire\CreateStudent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

    Route::get('/students', ListStudents::class)->name('students.index');
    Route::get('/students/create', CreateStudent::class)->name('students.create');
    Route::get('/students/{student}/edit', EditStudent::class)->name('students.edit');
});

require __DIR__.'/auth.php';
