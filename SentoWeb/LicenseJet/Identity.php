<?php namespace SentoWeb\LicenseJet;

use GuzzleHttp\Client;

Class Identity
{
    protected $apiUrl;

    protected $apiKey;

    /**
     * @var Client
     */
    public $client;

    public function __construct(string $apiUrl, string $apiKey)
    {
        // Make sure that the API URL ends in a forward slash
        if (strpos($apiUrl, "/") !== strlen($apiUrl) - 1)
        {
            $apiUrl .= "/";
        }

        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;

        // GuzzleHttp client
        $this->client = new Client([
            'base_uri' => $this->apiUrl
        ]);
    }

    public function getUrl($path = '') : string
    {
        return $this->normalize_url($this->apiUrl.'/'.$path);
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