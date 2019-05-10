<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseKeyCollection;
use SentoWeb\LicenseJet\Model\LicenseKey;
Use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;
use SentoWeb\LicenseJet\Response\Response;

Class LicenseKeyEndpoint extends Endpoint {
    /**
     * @param $license_key_id
     * @return bool|LicenseKey
     */
    public function license_key($license_key_id)
    {
        $response = $this->get('license_key/'.$license_key_id, []);

        if ($response->isSuccessful())
        {
            return new LicenseKey((array) $response->getPayload());
        }

        return false;
    }

    /**
     * @param LicenseKey $licenseKey
     * @return Response
     */
    public function delete_license_key(LicenseKey $licenseKey) : Response
    {
        return $this->delete('license_key/'.$licenseKey->getId());
    }

    /**
     * @return CollectionRequestBuilder
     */
    public function license_keys()
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
     * @param LicenseKey $license_key
     * @return Response|LicenseKey
     */
    public function create(LicenseKey $license_key) {
        $response = $this->post('license_keys', $license_key->toArray());

        if ($response->isSuccessful()) {
            $license_key->fill((array) $response->getPayload());
            return $license_key;
        }

        return $response;
    }
}