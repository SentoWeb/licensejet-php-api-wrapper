<?php namespace SentoWeb\LicenseJet\Endpoint;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use SentoWeb\LicenseJet\Identity;
use SentoWeb\LicenseJet\LicenseJet_Response;

Class Endpoint {
    public $identity;

    /**
     * ProjectRequest constructor.
     * @param Identity $identity
     */
    public function __construct(Identity $identity)
    {
        $this->identity = $identity;
    }

    protected function request(string $method, string $uri, array $queryParams = []) : LicenseJet_Response
    {
        $method = strtoupper($method);

        $client = $this->identity->client();

        $request = new Request($method, $uri, [
            'Authorization' => 'APIKEY '.$this->identity->getKey(),
            'Accept' => 'application/json'
        ]);

        $options = [];

        if ($method == 'POST' && !empty($queryParams))
        {
            $options[RequestOptions::FORM_PARAMS] = $queryParams;
        }
        elseif (!empty($queryParams))
        {
            $options[RequestOptions::QUERY] = $queryParams;
        }

        return new LicenseJet_Response($client->send($request, $options));
    }
}