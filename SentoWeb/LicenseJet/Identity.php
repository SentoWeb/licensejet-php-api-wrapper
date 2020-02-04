<?php namespace SentoWeb\LicenseJet;

use GuzzleHttp\Client;

Class Identity
{
    protected $apiUrl;

    protected $apiKey;
    
    protected $clientTimeout = 10;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $apiUrl, string $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function client() : Client
    {
        return new Client([
            'base_uri' => $this->apiUrl,
            'timeout' => $this->getClientTimeout(),
            'headers' => [
                'Authorization' => 'APIKEY '.$this->apiKey
            ]
        ]);
    }

    public function getUrl($path = '') : string
    {
        return $this->apiUrl.'/'.$this->normalize_url($path);
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

    /**
     * @return int
     */
    public function getClientTimeout(): int
    {
        return $this->clientTimeout;
    }

    /**
     * @param int $clientTimeout
     */
    public function setClientTimeout(int $clientTimeout)
    {
        $this->clientTimeout = $clientTimeout;
    }

}