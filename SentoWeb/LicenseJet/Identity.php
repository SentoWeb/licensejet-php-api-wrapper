<?php namespace SentoWeb\LicenseJet;

use GuzzleHttp\Client;

Class Identity
{
    protected $apiUrl;

    protected $apiKey;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $apiUrl, string $apiKey)
    {
        // @todo: add slash

        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;

        // GuzzleHttp client
        $this->client = new Client([
            'base_uri' => $this->apiUrl
        ]);
    }

    public function client() : Client
    {
        return $this->client;
    }

    public function getUrl($path = '') : string
    {
        return $this->normalize_url($this->apiUrl.$path);
    }

    public function getKey() :string
    {
        return $this->apiKey;
    }

    protected function normalize_url(string $url) : string
    {
        while (strpos($url, "//") !== false)
        {
            $url = str_replace("//", "/", $url);
        }

        return $url;
    }
}