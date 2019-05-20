<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseKeyCollection;
use SentoWeb\LicenseJet\Model\LicenseKey;
Use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;
use SentoWeb\LicenseJet\LicenseJet_Response;

Class LicenseKeyEndpoint extends Endpoint {
    /**
     * @param $licenseKeyId
     * @return null|LicenseKey
     */
    public function get($licenseKeyId) : ?LicenseKey
    {
        $response = $this->request('GET', 'license_key/'.$licenseKeyId, []);

        if ($response->isSuccessful())
        {
            return new LicenseKey((array) $response->getPayload());
        }

        return null;
    }

    /**
     * @param LicenseKey $licenseKey
     * @return LicenseJet_Response
     */
    public function delete(LicenseKey $licenseKey) : LicenseJet_Response
    {
        return $this->request('DELETE', 'license_key/'.$licenseKey->getId());
    }

    /**
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'license_keys',
            $this,
            function ($attributes) {
                return new LicenseKey((array) $attributes);
            },
            new LicenseKeyCollection()
        );
    }

    /**
     * @param LicenseKey $licenseKey
     * @return LicenseJet_Response|LicenseKey
     */
    public function create(LicenseKey $licenseKey)
    {
        $response = $this->request('GET', 'license_keys', $licenseKey->toArray());

        if ($response->isSuccessful())
        {
            $licenseKey->fill((array) $response->getPayload());
            return $licenseKey;
        }

        return $response;
    }
}