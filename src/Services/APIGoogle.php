<?php


namespace App\Services;


class APIGoogle
{
    public function getAPIGoogleResult(string $isbn) : ?array
    {
        $googleAPIRequest = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;

        $response = file_get_contents($googleAPIRequest);

        $results = json_decode($response, true);

        return $results['items'][0]['volumeInfo'] ?? null;
    }
}