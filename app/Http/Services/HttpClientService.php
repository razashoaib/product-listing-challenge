<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class HttpClientService
{
    private $baseUrl;
    private $header;

    public function __construct()
    {
        $this->baseUrl = config('app.iconic_api_url');
        $this->header = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * @param string $path
     * @param array $params
     * @return array|mixed
     */
    public function makeGetRequest(string $path, array $params = [])
    {
        $response = Http::withHeaders($this->header)->get("$this->baseUrl/$path", $params);
        return $response->json();
    }
}
