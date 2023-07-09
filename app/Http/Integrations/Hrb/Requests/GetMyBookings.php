<?php

namespace App\Http\Integrations\Hrb\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetMyBookings extends Request
{
    /**
     * Define the HTTP method
     */
    protected Method $method = Method::GET;

    protected string|null $emailGuest;

    public function __construct(string|null $emailGuest = null)
    {
        $this->emailGuest = $emailGuest;
    }

    /**
     * Define the endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/bookings/'.$this->emailGuest.'/my-bookings';
    }
}
