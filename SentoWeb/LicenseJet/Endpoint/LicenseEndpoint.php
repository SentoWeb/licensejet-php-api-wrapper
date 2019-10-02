<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseCollection;
use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\License;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class LicenseEndpoint extends Endpoint
{
    /**
     * List licenses.
     *
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'licenses',
            $this,
            function ($license) {
                return new License((array) $license);
            },
            new LicenseCollection()
        );
    }

    /**
     * Retrieve a License.
     *
     * @param $licenseId
     * @return null|License
     * @throws \Exception
     */
    public function get(int $licenseId) : License
    {
        $response = $this->request('GET', 'licenses/'.$licenseId, []);

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to retrieve resource. Error: '.$response->getErrorMessage());
    }

    public function renew(int $licenseId, ?string $term = null, ?int $length = null) : License
    {
        $response = $this->request('PUT', 'licenses/'.$licenseId.'/renewals', [
            'term' => $term,
            'length' => $length
        ]);

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to process renewal. Error: '.$response->getErrorMessage());
    }

    public function renewUpdateAccessTerm(int $licenseId, string $term, int $length) : License
    {
        $response = $this->request('PUT', 'licenses/'.$licenseId.'/update_access/term/renewals', [
            'term' => $term,
            'length' => $length
        ]);

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to process update access renewal. Error: '.$response->getErrorMessage());
    }

    public function renewUpdateAccessVersion(int $licenseId, string $version) : License
    {
        $response = $this->request('PUT', 'licenses/'.$licenseId.'/update_access/version/renewals', [
            'version' => $version
        ]);

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to process update access renewal. Error: '.$response->getErrorMessage());
    }

    /**
     * Delete a License.
     *
     * @param License $license
     * @return bool
     */
    public function delete(License $license) : bool
    {
        return $this->request('DELETE', 'licenses/'.$license->getId())->isSuccessful();
    }

    /**
     * Create a new Transfer on the License.
     *
     * @param License $license
     * @param int|null $recipientUserId
     * @return License
     * @throws \Exception
     */
    public function transfer(License $license, ?int $recipientUserId) : License
    {
        $response = $this->request('PUT','licenses/'.$license->getId().'/transfers', [
            'user_id' => $recipientUserId,
        ]);

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }

    /**
     * @param License $license
     * @return License
     * @throws LicenseJetException
     */
    public function create(License $license) : License
    {
        $response = $this->request('POST', 'licenses', $license->toArray());

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to create resource. Error: '.$response->getErrorMessage());
    }

    /**
     * @param License $license
     * @return License
     * @throws \Exception
     */
    public function update(License $license) : License
    {
        $response = $this->request('POST', 'licenses/'.$license->getId(), $license->toArray());

        if ($response->isSuccessful())
        {
            return License::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }
}