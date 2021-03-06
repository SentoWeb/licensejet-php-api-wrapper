<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseKeyCollection;
use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\LicenseKey;
Use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;
use SentoWeb\LicenseJet\Response;

Class LicenseKeyEndpoint extends Endpoint
{
    /**
     * @param $licenseKeyId
     * @return LicenseKey
     * @throws LicenseJetException
     */
    public function get(int $licenseKeyId) : LicenseKey
    {
        $response = $this->request('GET', 'license_keys/'.$licenseKeyId, []);

        if ($response->isSuccessful())
        {
            return LicenseKey::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to retrieve resource. Error: '.$response->getErrorMessage());
    }

    /**
     * @param LicenseKey $licenseKey
     * @return bool
     */
    public function delete(LicenseKey $licenseKey) : bool
    {
        return $this->request('DELETE', 'license_keys/'.$licenseKey->getKey())->isSuccessful();
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
     * @return LicenseKey
     * @throws LicenseJetException
     */
    public function create(LicenseKey $licenseKey) : LicenseKey
    {
        $response = $this->request('POST', 'license_keys', $licenseKey->toArray());

        if ($response->isSuccessful())
        {
            return LicenseKey::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to create resource. Error: '.$response->getErrorMessage());
    }
}