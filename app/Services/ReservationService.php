<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Room;


class ReservationService
{
    public function getAvailableHotelRooms(string $hotelId, string $checkIn, string $checkOut, array $filters)
    {
        $query = Room::where('available', true)
            ->where('hotel_id', $hotelId)
            ->whereDoesntHave('reservations', function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            });

        if (!empty($filters['room_type'])) {
            $query->where('room_type', $filters['room_type']);
        }

        if (!empty($filters['capacity'])) {
            $query->where('capacity', '>=', $filters['capacity']);
        }

        return $query->get();
    }

    public function createReservation(array $data)
    {
        $reservation = Reservation::create([
            'hotel_id' => $data['hotel_id'],
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out']
        ]);

        $reservation->rooms()->attach($data['rooms']);

        return $reservation->load('rooms');
    }


    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();
        return ['message' => 'Reservation canceled successfully.'];
    }
}
