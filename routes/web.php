<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\FleetController;
use App\Http\Controllers\Admin\OniController;
use App\Http\Controllers\Admin\ServiceBookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::view('login', 'auth.login')->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('calendar', [CalendarController::class, 'index'])->name('admin.calendar');

    Route::resource('fleet', FleetController::class)->names('admin.fleet');
    Route::get('vehicles/vtp/{filename}', [FleetController::class, 'serveVTP'])->name('vtp');
    Route::get('vehicles/api/by-oni-id/{oniId}', [FleetController::class, 'getByOniId'])->name('admin.fleet.by-oni-id');
    Route::resource('vehicles/{vehicle}/service-book', ServiceBookController::class)
        ->except('show')
        ->parameters([
            'service-book' => 'id',
        ])
        ->names('service-book');
    Route::get('vehicles/service-book/attachments/{id}', [ServiceBookController::class, 'serveAttachment'])->name('attachment');

    Route::resource('oni', OniController::class)->names('admin.oni');
    Route::get('oni/{oni}/export', [OniController::class, 'export'])->name('admin.oni.export');
    Route::get('oni/{oni}/map', [OniController::class, 'showMap'])->name('admin.oni.map');

    Route::get('sheets', [FleetController::class, 'sheets'])->name('admin.sheets');
});
