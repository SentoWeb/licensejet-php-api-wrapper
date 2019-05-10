<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Identity;
use SentoWeb\LicenseJet\Response\Response;

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

    private function get_params(array $params) : array
    {
        return array_merge(
            $params,
            [
                'key' => $this->identity->getKey()
            ]
        );
    }

    /**
     * @param $uri
     * @param $params
     * @return Response
     */
    public function get($uri, $params) : Response
    {
        $response = $this->identity->client->request('GET', $this->identity->getUrl($uri),  [
            'query' => $this->get_params($params)
        ]);

        return new Response($response->getBody()->getContents(), $response);
    }

    /**
     * @param $uri
     * @param $params
     * @return Response
     */
    public function put($uri, $params) : Response
    {
        $response = $this->identity->client->request('PUT', $this->identity->getUrl($uri),  [
            'query' => $this->get_params($params)
        ]);

        return new Response($response->getBody()->getContents(), $response);
    }

    /**
     * @param $uri
     * @param $params
     * @return Response
     */
    public function post($uri, $params) : Response
    {
        $response = $this->identity->client->post($this->identity->getUrl($uri), [
            'form_params' => $this->get_params($params)
        ]);

        return new Response($response->getBody()->getContents(), $response);
    }

    /**
     * @param $uri
     * @param array $params
     * @return Response
     */
    public function delete($uri, $params = []) : Response
    {
        $response = $this->identity->client->request('DELETE', $this->identity->getUrl($uri),  [
            'query' => $this->get_params($params)
        ]);

        return new Response($response->getBody()->getContents(), $response);
    }
}