<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('tasks')
    ->middleware(['auth', 'verified'])
    ->controller(TaskController::class)
    ->group(function() {
        Route::get('/', 'index')->name('tasks.index'); //TODO ->middleware('can:tasks.list')
        Route::get('/tasks-list', 'list')->name('tasks.list');
        Route::post('/tasks-save', 'store')->name('tasks.store');
        Route::get('/tasks-show', 'show')->name('tasks.show');
        Route::get('/tasks-edit/{id}/edit', 'edit')->name('tasks.edit');
        Route::put('/tasks-update/{id}', 'update')->name('tasks.update');
        Route::delete('/tasks-delete/{id}', 'destroy')->name('tasks.destroy');
    });

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
