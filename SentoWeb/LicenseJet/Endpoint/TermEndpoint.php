<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\BaseCollection;
use SentoWeb\LicenseJet\Resource\Term;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class TermEndpoint extends Endpoint
{
    /**
     * Retrieve Terms.
     *
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'terms',
            $this,
            function ($term)
            {
                return Term::createFromArray((array) $term);
            },
            new BaseCollection()
        );
    }
}