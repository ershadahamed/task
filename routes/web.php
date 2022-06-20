<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    });

    Route::group(['middleware' => ['role:admin|ctp']], function () {
        Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
        Route::post('/update/do', [TaskController::class, 'updateDo'])->name('update.do');
        Route::post('/task/printing', [TaskController::class, 'printing'])->name('task.printing');
        Route::post('/edit/do', [TaskController::class, 'editDo'])->name('edit.do');
        Route::post('/edit/customer_name', [TaskController::class, 'editCustomerName'])->name('update.customer_name');
        Route::get('/task/destroy/{id}', [TaskController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role:admin|logistic']], function () {
        Route::post('/task/delivered', [TaskController::class, 'delivered'])->name('task.delivered');
    });

    Route::get('/task/completed', [TaskController::class, 'completed'])->name('task.completed');
});