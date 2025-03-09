<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DaDataService extends ApiRequest
{
    public function __construct(public string $url, public string $token)
    {
    }

    public function findByInn(array $fields):\Illuminate\Http\Client\Response
    {
        return Http::withToken('Token ' . $this->token)->post($this->url, $fields);
    }
}
