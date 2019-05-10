<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\BaseCollection;
use SentoWeb\LicenseJet\Model\Term;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class TermEndpoint extends Endpoint {
    /**
     * @return BaseCollection
     */
    public function terms() {
        return (new CollectionRequestBuilder(
            $this->identity,
            'terms',
            $this,
            function ($project) {
                return new Term((array) $project);
            },
            new BaseCollection()
        ))->get();
    }
}