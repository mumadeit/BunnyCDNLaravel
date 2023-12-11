<?php

// Usage of the Service Package.
// use App/Services/BunnyCDNService.php.
namespace App\Services;

use GuzzleHttp\Client;

class BunnyCDNService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('BUNNYCDN_REGION'),
            'headers' => [
                'AccessKey' => env('BUNNYCDN_API_KEY'),
                'Content-Type' => 'application/octet-stream'
            ],
        ]);
    }

    public function uploadImage($filePath, $fileName)
    {

        $dir = '/' . env('BUNNYCDN_DIR') . '/';
        $storage = env('BUNNYCDN_STORAGE_ZONE_NAME');
        // Upload the file to BunnyCDN
        $response = $this->client->request('PUT', $storage . $dir . $fileName, [
            'body' => fopen($filePath, 'r'),
            'headers' => ['Content-Length' => filesize($filePath)]
        ]);

        return $response;
    }
}
