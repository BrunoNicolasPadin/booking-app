<?php

namespace App\Http\Controllers;

use App\Http\Actions\CloneBooking;
use App\Http\Integrations\Hrb\HrbConnector;
use App\Http\Integrations\Hrb\Requests\GetMyBookings;
use App\Http\Integrations\Hrb\Requests\GetRooms;
use App\Http\Integrations\Hrb\Requests\StoreBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hrb = new HrbConnector();
        $response = $hrb->send(new GetMyBookings((string) $user->email));
        return view('bookings.show', [
            'bookings' => $response->json(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $hrb = new HrbConnector();
        $response = $hrb->send(new GetRooms((string) $request->hotel, (int) $request->size, (int) $request->bath));

        return view('bookings.create', [
            'rooms' => $response->json('data'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->merge(['nameGuest' => $user->name, 'emailGuest' => $user->email]);
        $hrb = new HrbConnector();
        $hrb->send(new StoreBooking($request));

        return back();
    }

    public function clone(Request $request)
    {
        CloneBooking::run($request);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
