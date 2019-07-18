<?php


namespace App\Services;


class APIGoogle
{
    public function getAPIGoogleResults(string $isbn) : array
    {
        $googleAPIRequest = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;

        $response = file_get_contents($googleAPIRequest);

        $jsonResults = [];

        if ($response != '{}') {
            $jsonResults = json_decode($response, true);
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