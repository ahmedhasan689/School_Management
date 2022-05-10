<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\GradesController;
use App\Http\Controllers\Dashboard\ClassroomsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
require __DIR__ . '/auth.php';

Route::group(
    [
        'middleware' => ['guest']
    ], function() {

        Route::get('/', function() {
            return view('auth.login');
        });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

        // Start Home Page
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        // End Home Page

        // Start Grade Page
        Route::group(
            [
                'prefix' => 'grades',
                'as' => 'grade.',
            ], function() {
                Route::get('/', [GradesController::class, 'index'])->name('index');
                Route::get('/create', [GradesController::class, 'create'])->name('create');
                Route::post('/', [GradesController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [GradesController::class, 'edit'])->name('edit');
                Route::put('/{id}', [GradesController::class, 'update'])->name('update');
                Route::delete('/{id}', [GradesController::class, 'destroy'])->name('delete');
            });
        // End Grade Page

        // Start Classes Page
        Route::group(
            [
                'prefix' => 'classrooms',
                'as' => 'classroom.',
            ], function() {
                Route::get('/', [ClassroomsController::class, 'index'])->name('index');
                Route::get('/create', [ClassroomsController::class, 'create'])->name('create');
                Route::post('/', [ClassroomsController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ClassroomsController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [ClassroomsController::class, 'update'])->name('update');
                Route::delete('/{id}', [ClassroomsController::class, 'destroy'])->name('delete');
                // Delete Selected
                Route::post('/delete', [ClassroomsController::class, 'deleteAll'])->name('delete_all');
                // Search Route
                Route::post('/search', [ClassroomsController::class, 'search'])->name('search');
            });
        // End Classes Page
    }
);
