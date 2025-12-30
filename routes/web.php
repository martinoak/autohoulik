<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::view('login', 'auth.login')->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('calendar', [Admin\CalendarController::class, 'index'])->name('admin.calendar');

    Route::resource('fleet', Admin\FleetController::class)->names('admin.fleet');
    Route::get('vehicles/vtp/{filename}', [Admin\FleetController::class, 'serveVTP'])->name('vtp');
    Route::get('vehicles/api/by-oni-id/{oniId}', [Admin\FleetController::class, 'getByOniId'])->name('admin.fleet.by-oni-id');
    Route::resource('vehicles/{vehicle}/service-book', Admin\ServiceBookController::class)
        ->except('show')
        ->parameters([
            'service-book' => 'id',
        ])
        ->names('service-book');
    Route::get('vehicles/service-book/attachments/{id}', [Admin\ServiceBookController::class, 'serveAttachment'])->name('attachment');

    Route::get('cost-calc', [Admin\CostCalculatorController::class, 'index'])->name('admin.cost-calculator');
    Route::post('cost-calc/save', [Admin\CostCalculatorController::class, 'save'])->name('admin.cost-calculator.save');
    Route::get('cost-calc/load', [Admin\CostCalculatorController::class, 'load'])->name('admin.cost-calculator.load');

    Route::resource('oni', Admin\OniController::class)->names('admin.oni');
    Route::get('oni/{oni}/export', [Admin\OniController::class, 'export'])->name('admin.oni.export');
    Route::get('oni/{oni}/map', [Admin\OniController::class, 'showMap'])->name('admin.oni.map');

    Route::get('sheets', [Admin\SheetsController::class, 'sheets'])->name('admin.fleet.sheets');
    Route::get('sheets/export', [Admin\SheetsController::class, 'exportSheets'])->name('admin.fleet.sheets.export');
});
