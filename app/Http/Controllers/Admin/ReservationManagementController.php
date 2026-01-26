<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = \App\Models\Reservation::latest()->paginate(15);
        return view('reservations.index', compact('reservations'));
    }

    public function update(Request $request, \App\Models\Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Reservation status updated.');
    }

    public function destroy(\App\Models\Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted.');
    }
}
