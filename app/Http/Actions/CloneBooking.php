<?php

namespace App\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Integrations\Hrb\HrbConnector;
use App\Http\Integrations\Hrb\Requests\StoreBooking;

class CloneBooking
{
    use AsAction;

    public function handle(Request $request)
    {
        $user = Auth::user();
        $request->merge(['nameGuest' => $user->name, 'emailGuest' => $user->email]);
        $hrb = new HrbConnector();
        $response = $hrb->send(new StoreBooking($request));
    }
}