<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\Project;
use SentoWeb\LicenseJet\Collection\ProjectCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class ProjectEndpoint extends Endpoint
{
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

    /**
     * @param int $projectId
     * @return Project
     * @throws LicenseJetException
     */
    public function get(int $projectId) : Project
    {
        $response = $this->request('GET', 'project/'.$projectId, []);

        if ($response->isSuccessful())
        {
            return Project::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to retrieve resource. Error: '.$response->getErrorMessage());
    }

    /**
     * @param Project $project
     * @return Project
     * @throws LicenseJetException
     */
    public function update(Project $project) : Project
    {
        $response = $this->request(
            'POST',
            'projects/'.$project->getId(),
            $project->toArray()
        );

        if ($response->isSuccessful())
        {
            return Project::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }
}