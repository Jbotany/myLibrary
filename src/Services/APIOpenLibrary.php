<?php


namespace App\Services;


use Symfony\Component\HttpClient\HttpClient;

/**
 * This class calls the OpenLibrary API
 * Class APIOpenLibrary
 * @package App\Services
 */
class APIOpenLibrary
{
    public function getAPIOpenLibraryResults(string $isbn): array
    {
        $httpClient = HttpClient::create();

        $request = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";

        $response = $httpClient->request('GET', $request);

        $data = $response->getContent();

        $jsonResults = [];

        if ($data != '{}') {
            $jsonResults = json_decode($data, true);
        } else {
            $jsonResults["ISBN:$isbn"] = [];
        }

        return self::orderInRightFormat($jsonResults["ISBN:$isbn"]);
    }

    /**
     * Organize data in a standard format
     * @param array $data
     * @return array
     */
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