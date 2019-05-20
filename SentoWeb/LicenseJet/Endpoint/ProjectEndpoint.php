<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJet_Response;
use SentoWeb\LicenseJet\Model\Project;
use SentoWeb\LicenseJet\Collection\ProjectCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class ProjectEndpoint extends Endpoint {
    /**
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'projects',
            $this,
            function ($project) {
                return new Project((array) $project);
            },
            new ProjectCollection()
        );
    }

    public function get($projectId) : ?Project
    {
        $response = $this->request('GET', 'project/'.$projectId, []);

        if ($response->isSuccessful())
        {
            return new Project((array) $response->getPayload());
        }

        return null;
    }

    /**
     * @param Project $project
     * @return \SentoWeb\LicenseJet\LicenseJet_Response
     */
    public function update(Project $project) : LicenseJet_Response
    {
        return $this->request(
            'POST',
            'projects/'.$project->getId(),
            $project->toArray()
        );
    }
}