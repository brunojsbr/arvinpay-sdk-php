<?php

namespace ArvinPay\SDK\Resources;

use ArvinPay\SDK\Client;

class Pix
{
    private $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function create(array $data)
    {
        return $this->client->request('POST', '/pix/charges', [
            'json' => $data
        ]);
    }
    
    public function get($reference)
    {
        return $this->client->request('GET', "/pix/charges/{$reference}");
    }
    
    public function cancel($reference)
    {
        return $this->client->request('POST', "/pix/charges/{$reference}/cancel");
    }
} 