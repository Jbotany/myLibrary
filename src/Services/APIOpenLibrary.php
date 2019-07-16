<?php


namespace App\Services;


class APIOpenLibrary
{
    public function getAPIOpenLibraryResults(string $isbn): ?array
    {
        $request = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";

        $response = file_get_contents($request);

        $jsonResults = json_decode($response, true);

        $results = self::orderInRightFormat($jsonResults["ISBN:$isbn"]);

        return $results ?? null;
    }


    private function orderInRightFormat(array $data): array
    {
        $results['title'] = $data['title'] ?? null;

        $results['authors'] = [];

        foreach ($data['authors'] as $detail) {
            $results['authors'][] = $detail['name'] ?? null;
        }

        $results['publisher'] = $data['publishers'][0] ?? null;

        $results['cover'] = $data['cover']['small'] ?? null;

        $results['publishedAt'] = $data['publish_date'] ?? null;

        return $results;
    }


}