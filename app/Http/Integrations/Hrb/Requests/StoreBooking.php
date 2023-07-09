<?php

namespace App\Http\Integrations\Hrb\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;
use App\Http\Integrations\Hrb\HrbConnector;

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
     *
     * @return string
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
