<?php

namespace App\Http\Integrations\Hrb\Requests;

use App\Http\Integrations\Hrb\HrbConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class StoreBooking extends Request implements HasBody
{
    use HasConnector, HasJsonBody;

    protected string $connector = HrbConnector::class;

    protected Method $method = Method::POST;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Define the endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/bookings';
    }

    protected function defaultBody(): array
    {
        return [
            'room_id' => $this->request->room_id,
            'nameGuest' => $this->request->nameGuest,
            'emailGuest' => $this->request->emailGuest,
            'from' => $this->request->from,
            'end' => $this->request->end,
            'status' => $this->request->status,
        ];
    }
}
