<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseCollection;
use SentoWeb\LicenseJet\Model\License;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;
use SentoWeb\LicenseJet\LicenseJet_Response;

Class LicenseEndpoint extends Endpoint {
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
     */
    public function get($licenseId) : ?License
    {
        $response = $this->request('GET', 'license/'.$licenseId, []);

        if ($response->isSuccessful())
        {
            return new License((array) $response->getPayload());
        }

        return null;
    }

    /**
     * Delete a License.
     *
     * @param License $license
     * @return LicenseJet_Response
     */
    public function delete(License $license) : LicenseJet_Response
    {
        return $this->request('DELETE', 'license/'.$license->getId());
    }

    /**
     * Create a new Transfer on the License.
     *
     * @param License $license
     * @param int|null $recipientUserId
     * @return LicenseJet_Response
     */
    public function transfer(License $license, ?int $recipientUserId) : LicenseJet_Response
    {
        return $this->request('PUT','license/'.$license->getId().'/transfers', [
            'user_id' => $recipientUserId,
        ]);
    }

    /**
     * @param License $license
     * @return License|LicenseJet_Response
     */
    public function create(License $license)
    {
        $response = $this->request('POST', 'licenses', $license->toArray());

        if ($response->isSuccessful())
        {
            $license->fill((array) $response->getPayload());
            return $license;
        }

        return $response;
    }

    /**
     * @param License $license
     * @return License|LicenseJet_Response
     */
    public function update(License $license)
    {
        $response = $this->request('POST', 'license/'.$license->getId(), $license->toArray());

        if ($response->isSuccessful())
        {
            $license->fill((array) $response->getPayload());
            return $license;
        }

        return $response;
    }
}