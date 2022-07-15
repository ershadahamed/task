<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RequestsController;
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
    Route::post('/task/filtered', [TaskController::class, 'filtered'])->name('task.filtered');

    Route::group(['middleware' => ['role:admin|requestor|purchaser']], function () {
        Route::get('/requests', [RequestsController::class, 'index'])->name('requests.index');
        Route::get('/requests/view/{id}', [RequestsController::class, 'viewform']);
        Route::get('/requests/approved', [RequestsController::class, 'approved'])->name('requests.approved');
        Route::get('/requests/pdf/{id}', [RequestsController::class, 'exportPDF']);
    });

    Route::group(['middleware' => ['role:admin|requestor']], function () {
        Route::get('/requests/submitform', [RequestsController::class, 'submitform'])->name('requests.submitform');
        Route::post('/requests/storeform', [RequestsController::class, 'storeform'])->name('requests.storeform');
        Route::get('/requests/destroy/{id}', [RequestsController::class, 'destroy']);
        Route::get('/requests/edit/{id}', [RequestsController::class, 'editform']);
        Route::post('/requests/update', [RequestsController::class, 'updateform'])->name('requests.updateform');
    });
    
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/requests/approve/{id}', [RequestsController::class, 'approveform']);
    });
});

Route::get('cleanup', [TaskController::class, 'deleteMoreThan7Days']);