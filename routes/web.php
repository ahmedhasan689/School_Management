<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\GradesController;
use App\Http\Controllers\Dashboard\ClassroomsController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\TeacherController;
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

        // Start Section Route
        Route::group([
            'prefix' => 'sections',
            'as' => 'section.'
        ], function() {
             Route::get('/', [SectionController::class, 'index'])->name('index');
             Route::get('/create', [SectionController::class, 'create'])->name('create');
             Route::post('/', [SectionController::class, 'store'])->name('store');
             Route::get('/{id}/edit', [SectionController::class, 'edit'])->name('edit');
             Route::patch('/{id}', [SectionController::class, 'update'])->name('update');
             Route::delete('/{id}', [SectionController::class, 'destroy'])->name('delete');

            // For Ajax (Get_class) Function
            Route::get('/class/{id}', [SectionController::class, 'getClass'])->name('get_class');
        });
        // End Section Route

        // Start Parent Route [ **No Controller Just Livewire** ]
        Route::group([
            'prefix' => 'parents',
            'as' => 'parent.',
        ], function () {
            Route::view('/', 'livewire.index')->name('index');
        });
        // End Parent Route [ **No Controller Just Livewire** ]

        // Start Teacher Route
        Route::group([
            'prefix' => 'teachers',
            'as' => 'teacher.'
        ], function() {
            Route::get('/', [TeacherController::class, 'index'])->name('index');
            Route::get('/create', [TeacherController::class, 'create'])->name('create');
            Route::post('/', [TeacherController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TeacherController::class, 'update'])->name('update');
            Route::delete('/', [TeacherController::class, 'destroy'])->name('delete');
        });
        // End Teacher Route

        // Start Student Route
        Route::group([
            'prefix' => 'students',
            'as' => 'student.',
        ], function() {
            Route::get('/', [StudentController::class, 'index'])->name('index');
            Route::get('/create', [StudentController::class, 'create'])->name('create');
            Route::post('/', [StudentController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StudentController::class, 'update'])->name('update');
            Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');

            // For Ajax
            Route::get('/getClassrooms/{id}', [StudentController::class, 'getClassrooms'])->name('classroom');
            Route::get('/getSections/{id}', [StudentController::class, 'getSections'])->name('section');
        });
        // End Student Route
    }
);
