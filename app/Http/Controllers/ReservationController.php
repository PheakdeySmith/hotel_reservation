<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reservations.reservation');
    }

    public function list(Request $request)
{
    $start = date('Y-m-d', strtotime($request->start));
    $end = date('Y-m-d', strtotime($request->end));

    $reservations = Reservation::join('customers', 'reservations.customer_id', '=', 'customers.customer_id')
        ->select('reservations.*', 'customers.customer_name')
        ->where('check_in_date', '>=', $start)
        ->where('check_out_date', '<=', $end)
        ->get()
        ->map(function ($item) {
            $backgroundColor = null;
            $borderColor = null;

            switch ($item->category) {
                case 'info':
                    $backgroundColor = 'rgba(1,104,250, .15)';
                    $borderColor = '#0168fa';
                    break;
                case 'warning':
                    $backgroundColor = 'rgba(0,204,204,.25)';
                    $borderColor = '#00cccc';
                    break;
                case 'success':
                    $backgroundColor = 'rgba(16,183,89, .25)';
                    $borderColor = '#10b759';
                    break;
                case 'danger':
                    $backgroundColor = 'rgba(241,0,117,.25)';
                    $borderColor = '#f10075';
                    break;
                default:
                    // For other categories, you can set default colors or leave them null
                    break;
            }

            return [
                'id' => $item->reservation_id,
                'title' => $item->customer_name,
                'start' => $item->check_in_date,
                'end' => date('Y-m-d', strtotime($item->check_out_date . '+1 days')),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'extendedProps' => [
                    'number_of_days' => $item->number_of_days,
                    'number_of_adults' => $item->number_of_adults,
                    'number_of_children' => $item->number_of_children,
                    'is_checked_in' => $item->is_checked_in,
                    'is_checked_out' => $item->is_checked_out
                ],
                'description' => $item->description
            ];
        });

    return response()->json($reservations);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(Reservation $reservation)
    {
        return view('admin.reservations.reservation-form', ['data' => $reservation, 'action' => route('reservation.store')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request, Reservation $event)
    {
        return $this->update($request, $event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        if ($request->has('delete')) {
            return $this->destroy($reservation);
        }

        $reservation->customer_id = $request->customer_id;
        $reservation->check_in_date = $request->check_in_date;
        $reservation->check_out_date = $request->check_out_date;
        $reservation->number_of_days = $request->number_of_days;
        $reservation->number_of_adults = $request->number_of_adults;
        $reservation->number_of_children = $request->number_of_children;
        $reservation->description = $request->description;
        $reservation->category = $request->category;

        $reservation->save();

        // Redirect to the reservation.index route
        return redirect()->route('reservation.index')->with('success', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}
