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
    public function licensing_agreements() {
        return new CollectionRequestBuilder(
            $this->identity,
            'licensing_agreements',
            $this,
            function ($project) {
                return new LicensingAgreement((array) $project);
            },
            new LicensingAgreementCollection()
        );
    }

    /**
     * Get licensing agreement by ID.
     *
     * @param $licensing_agreement_id
     * @return bool|LicensingAgreement
     */
    public function licensing_agreement($licensing_agreement_id) {
        $response = $this->get('licensing_agreement/'.$licensing_agreement_id, []);

        if ($response->isSuccessful()) {
            return new LicensingAgreement((array) $response->getPayload());
        }

        return false;
    }

    /**
     * Update a licensing agreement.
     *
     * @param LicensingAgreement $licensingAgreement
     * @return \SentoWeb\LicenseJet\Response\Response
     */
    public function update(LicensingAgreement $licensingAgreement) {
        return $this->post($this->identity->getUrl('licensing_agreement/'.$licensingAgreement->getId()), $licensingAgreement->toArray());
    }
}