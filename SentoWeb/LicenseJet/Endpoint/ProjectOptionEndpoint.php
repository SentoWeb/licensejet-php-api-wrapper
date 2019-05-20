<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\ProjectOptionCollection;
use SentoWeb\LicenseJet\Resource\ProjectOption;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class ProjectOptionEndpoint extends Endpoint {
    /**
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'project_options',
            $this,
            function ($project) {
                return new ProjectOption((array) $project);
            },
            new ProjectOptionCollection()
        );
    }
}