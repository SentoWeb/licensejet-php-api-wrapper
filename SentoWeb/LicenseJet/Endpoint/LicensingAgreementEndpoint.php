<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Model\LicensingAgreement;
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
     * @return null|LicensingAgreement
     */
    public function get($licensingAgreementId) : ?LicensingAgreement
    {
        $response = $this->request('GET', 'licensing_agreement/'.$licensingAgreementId, []);

        if ($response->isSuccessful())
        {
            return new LicensingAgreement((array) $response->getPayload());
        }

        return null;
    }

    /**
     * Update a licensing agreement.
     *
     * @param LicensingAgreement $licensingAgreement
     * @return \SentoWeb\LicenseJet\LicenseJet_Response
     */
    public function update(LicensingAgreement $licensingAgreement)
    {
        return $this->request(
            'POST',
            'licensing_agreement/'.$licensingAgreement->getId(),
            $licensingAgreement->toArray()
        );
    }
}