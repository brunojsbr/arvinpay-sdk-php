<?php

namespace ArvinPay\SDK;

use GuzzleHttp\Client as HttpClient;

class Client
{
    private $httpClient;
    private $apiKey;
    private $baseUrl;
    
    public function __construct(array $config)
    {
        $this->apiKey = $config['client_secret'] ?? null;
        $this->baseUrl = $config['base_url'] ?? 'https://api.arvinpay.com/v1';
        
        if (!$this->apiKey) {
            throw new \InvalidArgumentException('Client secret é obrigatório');
        }
        
        $this->httpClient = new HttpClient([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        
        $this->pix = new Resources\Pix($this);
        $this->pixout = new Resources\Pixout($this);
    }
    
    public function request($method, $endpoint, array $options = [])
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception('Erro na requisição: ' . $e->getMessage());
        }
    }
} 