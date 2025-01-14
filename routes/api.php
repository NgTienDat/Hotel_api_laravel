<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;


Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{id}/rooms/available', [RoomController::class, 'getAvailableRooms']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
