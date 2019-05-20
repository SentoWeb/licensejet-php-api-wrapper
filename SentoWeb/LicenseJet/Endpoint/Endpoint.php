<?php namespace SentoWeb\LicenseJet\Endpoint;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use SentoWeb\LicenseJet\Identity;
use SentoWeb\LicenseJet\Response;
use SentoWeb\LicenseJet\LicenseJetException;

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

    /**
     * @param string $method
     * @param string $uri
     * @param array $queryParams
     * @return Response
     * @throws LicenseJetException
     */
    public function request(string $method, string $uri, array $queryParams = []) : Response
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

        try
        {
            return new Response($client->send($request, $options));
        }
        catch (\Throwable $e)
        {
            throw new LicenseJetException('Request failed. Error: '.$e->getMessage(), null, $e);
        }
    }
}