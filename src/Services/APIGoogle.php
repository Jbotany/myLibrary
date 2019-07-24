<?php


namespace App\Services;


use Symfony\Component\HttpClient\HttpClient;

class APIGoogle
{
    public function getAPIGoogleResults(string $isbn) : array
    {
        $httpClient = HttpClient::create();

        $googleAPIRequest = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;

        $response = $httpClient->request('GET', $googleAPIRequest);

        $data = $response->getContent();

        $jsonResults = [];

        if ($data != '{}') {
            $jsonResults = json_decode($data, true);
        } else {
            $jsonResults['items'][0]['volumeInfo'] = [];
        }

        return self::orderInRightFormat($jsonResults['items'][0]['volumeInfo']);
    }

    private function orderInRightFormat(array $data): array
    {
        $results['title'] = $data['title'] ?? null;

        $results['authors'] = [];
        if (isset($data['authors'])) {
            foreach ($data['authors'] as $detail) {
                $results['authors'][] = $detail ?? '';
            }
        }

        $results['publisher'] = $data['publishers'] ?? '';
        $results['cover'] = $data['imageLinks']['smallThumbnail'] ?? '';
        $results['publishedAt'] = $data['publishedDate'] ?? '';
        $results['description'] = $data['description'] ?? '';

        return $results;
    }
}