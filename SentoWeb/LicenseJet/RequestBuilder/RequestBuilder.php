<?php namespace SentoWeb\LicenseJet\RequestBuilder;


use SentoWeb\LicenseJet\Collection\BaseCollection;
use SentoWeb\LicenseJet\Endpoint\Endpoint;
use SentoWeb\LicenseJet\Identity;

Abstract Class RequestBuilder {
    protected $identity;
    protected $endpoint;
    protected $callback;
    protected $uri;
    protected $collection;

    protected $page = 1;

    protected $limit = -1;

    public function __construct(Identity $wrapper, $uri, Endpoint $endpoint, $callback = null, BaseCollection $collection)
    {
        $this->identity = $wrapper;
        $this->uri = $uri;
        $this->endpoint = $endpoint;
        $this->callback = $callback;
        $this->collection = $collection;
    }

    public function page(int $page) : RequestBuilder
    {
        $this->page = $page;

        return $this;
    }

    public function limit(?int $limit) : RequestBuilder
    {
        $this->limit = $limit;

        return $this;
    }

    public function getParams() : array
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page
        ];
    }

    abstract function get(array $params = [], &$response = null);
}