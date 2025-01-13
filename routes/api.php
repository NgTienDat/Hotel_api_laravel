<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;

Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/available', [RoomController::class, 'available']);
Route::post('/reservation', [ReservationController::class, 'store']);
Route::delete('/reservation/{id}', [ReservationController::class, 'destroy']);
