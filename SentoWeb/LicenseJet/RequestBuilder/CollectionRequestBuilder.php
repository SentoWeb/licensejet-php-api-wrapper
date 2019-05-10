<?php namespace SentoWeb\LicenseJet\RequestBuilder;

use SentoWeb\LicenseJet\Collection\BaseCollection;
use SentoWeb\LicenseJet\Collection\CollectionIterator;

Class CollectionRequestBuilder extends RequestBuilder {
    /**
     * @param array $params
     * @param $response
     * @return BaseCollection
     */
    function get(array $params = [], &$response = null)
    {

        $response = $this->endpoint->get($this->uri,
            array_merge($params, $this->getParams())
        );

        if (!$response->isSuccessful()) {
            return $this->collection;
        }

        $response_contents = $response->getContents();

        if (!isset($response_contents['results'])) {
            return $this->collection;
        }

        if (is_callable($this->callback)) {
            $return = array_map($this->callback, $response_contents['results']);
        } else {
            $return = $response_contents['results'];
        }

        $this->collection->setItems($return);

        return $this->collection;
    }

    function getIterator($per_page = 10, array $params = [], &$response = null)  : CollectionIterator
    {
        return new CollectionIterator($this, $params, $response, 1, $per_page);
    }
}