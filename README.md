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

// A resposta incluirá:
// - reference: Referência única da cobrança
// - total: Valor total
// - txid: ID da transação PIX
// - qr_code_data: String para gerar o QR Code
// - copy_paste: Código PIX Copia e Cola

// Exemplo de resposta:
// {
//     "reference": "PIX-123ABC",
//     "total": "100.00",
//     "txid": "9d36b84f-c70b-4e21-b49d-4444d98a5222",
//     "qr_code_data": "00020101021226890014br.gov.bcb.pix...",
//     "copy_paste": "00020101021226890014br.gov.bcb.pix..."
// }

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

## Gerando QR Code

O SDK retorna os dados necessários para gerar o QR Code (`qr_code_data`), mas não gera a imagem diretamente. 
Você pode usar qualquer biblioteca de sua preferência para gerar o QR Code. Alguns exemplos:

### Usando endroid/qr-code
```php
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$writer = new PngWriter();
$qrCode = QrCode::create($charge['qr_code_data']);
$result = $writer->write($qrCode);

// Salvar imagem
$result->saveToFile('qrcode.png');

// Ou retornar como base64
$dataUri = $result->getDataUri();
```

### Usando chillerlan/php-qrcode
```php
use chillerlan\QRCode\QRCode;

$qrcode = (new QRCode)->render($charge['qr_code_data']);
```

### Usando bacon/bacon-qr-code
```php
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

$renderer = new ImageRenderer(
    new RendererStyle(300),
    new ImagickImageBackEnd()
);

$writer = new Writer($renderer);
$qrcode = base64_encode($writer->writeString($charge['qr_code_data']));
```

## Documentação

Para mais informações sobre os endpoints e parâmetros disponíveis, consulte a [documentação oficial](https://api.arvinpay.com/docs).

## Requisitos

- PHP 7.2 ou superior
- Extensão JSON
- Guzzle HTTP 7.0 ou superior

## Licença

MIT 
