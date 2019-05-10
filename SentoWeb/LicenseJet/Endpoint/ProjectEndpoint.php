<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Model\Project;
use SentoWeb\LicenseJet\Collection\ProjectCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class ProjectEndpoint extends Endpoint {
    /**
     * @return CollectionRequestBuilder
     */
    public function projects() {
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

    public function project($projectId) {

    }

    /**
     * @param Project $project
     * @return \SentoWeb\LicenseJet\Response\Response
     */
    public function updateProject(Project $project) {
        return $this->post(
            'projects/'.$project->getId(),
            [
                'name' => $project->getName()
            ]
        );
    }
}