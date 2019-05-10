<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\ProjectOptionCollection;
use SentoWeb\LicenseJet\Model\ProjectOption;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class ProjectOptionEndpoint extends Endpoint {
    /**
     * @return CollectionRequestBuilder
     */
    public function get_options() {
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