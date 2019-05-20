<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\RequestBuilder\RequestBuilder;

Class CollectionIterator implements \Iterator
{
    protected $requestBuilder;
    protected $params;
    protected $response;
    protected $page;
    protected $limit;

    /**
     * @var BaseCollection
     */
    protected $data = null;

    private $position = 0;

    public function __construct(RequestBuilder $requestBuilder, array $params, &$response, $page, $per_page)
    {
        $this->requestBuilder = $requestBuilder;
        $this->params = $params;
        $this->response = $response;

        $this->page = $page;
        $this->limit = $per_page;
    }

    private function getData()
    {
        if ($this->data === null)
        {
            $this->data = $this->requestBuilder->page($this->page)->limit($this->limit)->get($this->params);
        }

        if ($this->data instanceof BaseCollection)
        {
            return $this->data;
        }

        return null;
    }

    private function resetData()
    {
        $this->data = null;
    }

    public function rewind()
    {
        $this->position = 0;

        if ($this->page != 1) {
            $this->resetData();
        }

        $this->getData();
    }

    public function current()
    {
        $data = $this->getData();

        return $data[$this->position];
    }

    public function next()
    {
        if ($this->position == $this->limit - 1) {
            $this->page++;
            $this->position = 0;
            $this->resetData();
        } else {
            $this->position++;
        }
    }

    public function valid() : bool
    {
        $data = $this->getData();

        return $this->position < $data->count() && isset($data[$this->position]);
    }

    public function key()
    {
        return $this->position;
    }

    public function toArray() : array
    {
        $data = $this->getData();

        if ($data instanceof BaseCollection)
        {
            return $data->toArray();
        }

        return [];
    }
}