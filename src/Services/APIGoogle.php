<?php


namespace App\Services;


class APIGoogle
{
    public function getAPIGoogleResults(string $isbn) : array
    {
        $googleAPIRequest = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;

        $response = file_get_contents($googleAPIRequest);

        $results = json_decode($response, true);

        return self::orderInRightFormat($results['items'][0]['volumeInfo']);
    }

    private function orderInRightFormat(array $data): array
    {
        $results['title'] = $data['title'] ?? null;

        $results['authors'] = [];
        foreach ($data['authors'] as $detail) {
            $results['authors'][] = $detail['name'] ?? '';
        }

        $results['publisher'] = $data['publishers'] ?? '';
        $results['cover'] = $data['imageLinks']['smallThumbnail'] ?? '';
        $results['publishedAt'] = $data['publishedDate'] ?? '';
        $results['description'] = $data['description'] ?? '';

        return $results;
    }
}