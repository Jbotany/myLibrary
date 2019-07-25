<?php


namespace App\Services;

/**
 * Mix data of different APIs and return array
 * Class APIMixer
 * @package App\Services
 */
class APIMixer
{
    private $openLibrary;
    private $google;

    public function __construct(APIOpenLibrary $openLibrary, APIGoogle $google)
    {
        $this->openLibrary = $openLibrary;
        $this->google = $google;
    }

    /**
     * Mix data of APIs results
     * @param string $isbn
     * @return array
     */
    public function mixAPIResults(string $isbn): array
    {
        $openLibraryResults = $this->openLibrary->getAPIOpenLibraryResults($isbn);
        $googleResults = $this->google->getAPIGoogleResults($isbn);

        $apiResults = [$openLibraryResults ?? '', $googleResults ?? ''];

        $results = [];

        foreach ($apiResults as $tables) {
            foreach ($tables as $key => $value) {
                if (!array_key_exists($key, $results) ||
                    ($key != 'authors' && (strlen($results[$key]) < strlen($value))) ||
                    ($key === 'authors' && count($results[$key]) < count($value))) {
                    $results[$key] = $value;
                }
            }
        }

        return $results;
    }
}