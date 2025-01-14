<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservationService;

class RoomController extends Controller
{
    protected $reservationService;
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function getAvailableRooms(Request $request, $id)
    {
        $validated = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_type' => 'sometimes|string',
            'capacity' => 'sometimes|integer|min:1'
        ]);

        $filter = [
            'room_type' => $request->input('room_type'),
            'capacity' => $request->input('capacity')
        ];

        $availableRooms = $this->reservationService->getAvailableHotelRooms($id, $validated['check_in'], $validated['check_out'], $filter);

        return response()->json($availableRooms, 200);
    }
}
