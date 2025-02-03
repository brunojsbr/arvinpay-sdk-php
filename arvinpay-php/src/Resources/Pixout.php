<?php

namespace ArvinPay\SDK\Resources;

use ArvinPay\SDK\Client;

class Pixout
{
    private $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function create(array $data)
    {
        return $this->client->request('POST', '/pix/withdrawals', [
            'json' => $data
        ]);
    }
    
    public function get($reference)
    {
        return $this->client->request('GET', "/pix/withdrawals/{$reference}");
    }
} 