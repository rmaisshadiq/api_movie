<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService {
    protected $client;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = env('RAPIDAPI_KEY'); // Ambil API key dari file .env
    }

    // Fungsi untuk mendapatkan semua tim
    public function getMovie($imdbId) {
        try {
            $response = $this->client->request('GET', "https://movies-ratings2.p.rapidapi.com/ratings?id={$imdbId}", [
                'headers' => [
                    'x-rapidapi-key' => $this -> apiKey
                ],
                'verify' => false // Menonaktifkan verifikasi SSL
            ]);
            // return json_decode($response->getBody()->getContents(), true);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}