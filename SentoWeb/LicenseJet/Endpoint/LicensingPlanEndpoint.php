<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\LicensingPlan;
use SentoWeb\LicenseJet\Collection\LicensingPlanCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class LicensingPlanEndpoint extends Endpoint
{
    /**
     * Get licensing plans.
     *
     * @return CollectionRequestBuilder
     */
    public function list() {
        return new CollectionRequestBuilder(
            $this->identity,
            'licensing_plans',
            $this,
            function ($project)
            {
                return new LicensingPlan((array) $project);
            },
            new LicensingPlanCollection()
        );
    }

    /**
     * Get licensing plan by ID.
     *
     * @param $licensingPlanId
     * @return LicensingPlan
     * @throws LicenseJetException
     */
    public function get(int $licensingPlanId) : LicensingPlan
    {
        $response = $this->request('GET', 'licensing_plans/'.$licensingPlanId, []);

        if ($response->isSuccessful())
        {
            return LicensingPlan::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }

    /**
     * Update a licensing plan.
     *
     * @param LicensingPlan $licensingPlan
     * @return LicensingPlan
     * @throws LicenseJetException
     */
    public function update(LicensingPlan $licensingPlan) : LicensingPlan
    {
        $response = $this->request(
            'POST',
            'licensing_plans/'.$licensingPlan->getId(),
            $licensingPlan->toArray()
        );

        if ($response->isSuccessful())
        {
            return LicensingPlan::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }
}