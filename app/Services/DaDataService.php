<?php

namespace App\Services;

use App\Exceptions\TooManyRequests;
use Exception;

class DaDataService
{
    private string $url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party';

    public function findById(array $fields): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Token ' . env('DADATA_TOKEN'),
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $data = json_decode(curl_exec($ch), true);
        $this->executeRequest($ch);
        curl_close($ch);
        return $data;
    }

    private function executeRequest(\CurlHandle $ch): void
    {
        $info = curl_getinfo($ch);
        if ($info['http_code'] == 429) {
            throw new TooManyRequests();
        } elseif ($info['http_code'] != 200) {
            throw new Exception('Request failed with http code ' . $info['http_code']);
        }
    }
}
