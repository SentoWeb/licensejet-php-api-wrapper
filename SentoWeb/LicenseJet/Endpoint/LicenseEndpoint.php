<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Collection\LicenseCollection;
use SentoWeb\LicenseJet\Model\License;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;
use SentoWeb\LicenseJet\Response\Response;

Class LicenseEndpoint extends Endpoint {
    /**
     * List licenses.
     *
     * @return CollectionRequestBuilder
     */
    public function licenses() : CollectionRequestBuilder
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
     * @param $license_id
     * @return null|License
     */
    public function license($license_id) : ?License
    {
        $response = $this->get('license/'.$license_id, []);

        if ($response->isSuccessful()) {
            return new License((array) $response->getPayload());
        }

        return null;
    }

    /**
     * Delete a License.
     *
     * @param License $license
     * @return Response
     */
    public function deleteLicense(License $license) : Response
    {
        return $this->delete('license/'.$license->getId());
    }

    /**
     * Create a new Transfer on the License.
     *
     * @param License $license
     * @param int|null $recipient_user_id
     * @return Response
     */
    public function transferLicense(License $license, ?int $recipient_user_id) : Response
    {
        return $this->post('license/'.$license->getId().'/transfers', [
            'user_id' => $recipient_user_id,
        ]);
    }

    /**
     * @todo: double check with WP integration (it may expect false!)
     *
     * @param License $license
     * @return License|Response
     */
    public function createLicense(License $license)
    {
        $response = $this->post('licenses', $license->toArray());

        if ($response->isSuccessful())
        {
            $license->fill((array) $response->getPayload());
            return $license;
        }

        return $response;
    }

    /**
     * @param License $license
     * @return License|Response
     */
    public function updateLicense(License $license)
    {
        $response = $this->post('license/'.$license->getId(), $license->toArray());

        if ($response->isSuccessful())
        {
            $license->fill((array) $response->getPayload());
            return $license;
        }

        return $response;
    }
}