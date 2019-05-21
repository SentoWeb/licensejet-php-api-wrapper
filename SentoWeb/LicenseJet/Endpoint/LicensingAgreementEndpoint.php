<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\LicensingAgreement;
use SentoWeb\LicenseJet\Collection\LicensingAgreementCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class LicensingAgreementEndpoint extends Endpoint {
    /**
     * Get licensing agreements.
     *
     * @return CollectionRequestBuilder
     */
    public function list() {
        return new CollectionRequestBuilder(
            $this->identity,
            'licensing_agreements',
            $this,
            function ($project)
            {
                return new LicensingAgreement((array) $project);
            },
            new LicensingAgreementCollection()
        );
    }

    /**
     * Get licensing agreement by ID.
     *
     * @param $licensingAgreementId
     * @return LicensingAgreement
     * @throws LicenseJetException
     */
    public function get(int $licensingAgreementId) : LicensingAgreement
    {
        $response = $this->request('GET', 'licensing_agreement/'.$licensingAgreementId, []);

        if ($response->isSuccessful())
        {
            return LicensingAgreement::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }

    /**
     * Update a licensing agreement.
     *
     * @param LicensingAgreement $licensingAgreement
     * @return LicensingAgreement
     * @throws LicenseJetException
     */
    public function update(LicensingAgreement $licensingAgreement) : LicensingAgreement
    {
        $response = $this->request(
            'POST',
            'licensing_agreement/'.$licensingAgreement->getId(),
            $licensingAgreement->toArray()
        );

        if ($response->isSuccessful())
        {
            return LicensingAgreement::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }
}