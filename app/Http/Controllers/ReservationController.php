<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;

class ReservationController extends Controller
{
    protected $reservationService;
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required',
            'rooms' => 'required|array',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);

        $reservation = $this->reservationService->createReservation($validated);

        return response()->json($reservation, 201);
    }

    public function destroy($id)
    {
        if (!$id) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }
        return response()->json($this->reservationService->cancelReservation($id), 200);
    }
}
