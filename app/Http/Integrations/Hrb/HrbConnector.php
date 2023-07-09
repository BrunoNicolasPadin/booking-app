<?php

namespace App\Http\Integrations\Hrb;

use Saloon\Http\Connector;
use Saloon\Contracts\HasPagination;
use Saloon\Traits\Plugins\AcceptsJson;

class HrbConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'http://127.0.0.1:8081/api/';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
