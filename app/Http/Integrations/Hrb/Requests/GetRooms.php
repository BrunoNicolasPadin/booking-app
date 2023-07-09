<?php

namespace App\Http\Integrations\Hrb\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRooms extends Request
{
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;
    protected string|null $hotel;
    protected int|null $size;
    protected int|null $bath;
    
    public function __construct(string|null $hotel = null, int|null $size = null, int|null $bath = null)
    {
        $this->hotel = $hotel;
        $this->size = $size;
        $this->bath = $bath;
    }
    
    protected function defaultQuery(): array
    {
        return [
            'hotel' => $this->hotel,
            'size' => $this->size,
            'bath' => $this->bath,
        ];
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/rooms';
    }
}
