<?php


namespace App\Services;


class APIOpenLibrary
{
    public function getAPIOpenLibraryResults(string $isbn): array
    {
        $request = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";

        $response = file_get_contents($request);

        $jsonResults = [];

        if ($response != '{}') {
            $jsonResults = json_decode($response, true);
        } else {
            $jsonResults["ISBN:$isbn"] = [];
        }

        return self::orderInRightFormat($jsonResults["ISBN:$isbn"]);
    }


    private function orderInRightFormat(array $data): array
    {
        $results['title'] = $data['title'] ?? '';

        $results['authors'] = [];
        if (isset($data['authors'])) {
            foreach ($data['authors'] as $detail) {
                $results['authors'][] = $detail['name'] ?? '';
            }
        }


        $results['publisher'] = $data['publishers'][0]['name'] ?? '';
        $results['cover'] = $data['cover']['small'] ?? '';
        $results['publishedAt'] = $data['publish_date'] ?? '';
        $results['description'] = $data['description'] ?? '';

        return $results;
    }
}