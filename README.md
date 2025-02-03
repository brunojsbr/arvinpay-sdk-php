# ArvinPay SDK PHP

SDK oficial da ArvinPay para integração com PHP.

## Instalação

```bash
composer require brunojsbr/arvinpay-sdk-php
```

## Uso

```php
use ArvinPay\SDK\Client;

// Inicializar o cliente
$client = new Client([
    'client_secret' => 'seu_client_secret',
    'base_url' => 'https://api.arvinpay.com/v1' // opcional
]);

// Criar uma cobrança PIX
$charge = $client->pix->create([
    'amount' => 100.00,
    'email' => 'cliente@email.com',
    'quantity' => 1,
    'invoice_no' => 'INV-123',
    'due_date' => '2024-12-31',
    'item_name' => 'Produto Teste',
    'document' => '123.456.789-00',
    'client' => 'Nome do Cliente'
]);

// Consultar uma cobrança
$status = $client->pix->get('PIX-123ABC');

// Cancelar uma cobrança
$cancel = $client->pix->cancel('PIX-123ABC');

// Criar um saque PIX
$withdraw = $client->pixout->create([
    'amount' => 100.00,
    'pixkey' => 'cliente@email.com',
    'keytype' => 'email',
    'description' => 'Saque PIX'
]);

// Consultar um saque
$status = $client->pixout->get('WD-123ABC');

// Cancelar um saque
$cancel = $client->pixout->cancel('WD-123ABC');
```

## Documentação

Para mais informações sobre os endpoints e parâmetros disponíveis, consulte a [documentação oficial](https://api.arvinpay.com/docs).

## Requisitos

- PHP 7.4 ou superior
- Extensão JSON
- Guzzle HTTP 7.0 ou superior
- Endroid QR Code 6.0 ou superior
- Chillerlan QR Code 5.0 ou superior

## Licença

MIT 
