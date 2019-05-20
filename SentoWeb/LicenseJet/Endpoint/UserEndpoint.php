<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJet_Response;
use SentoWeb\LicenseJet\Model\User;
use SentoWeb\LicenseJet\Collection\UserCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class UserEndpoint extends Endpoint {
    /**
     * Get user by ID.
     *
     * @param $userId
     * @return bool|User
     */
    public function get($userId) : ?User
    {
        $response = $this->request('GET', 'user/'.$userId);

        if ($response->isSuccessful())
        {
            return new User((array) $response->getPayload());
        }

        return false;
    }

    /**
     * @return CollectionRequestBuilder
     */
    public function list() : CollectionRequestBuilder
    {
        return new CollectionRequestBuilder(
            $this->identity,
            'users',
            $this,
            function ($project) {
                return new User((array) $project);
            },
            new UserCollection()
        );
    }

    /**
     * @param User $user
     * @return LicenseJet_Response|User
     */
    public function create(User $user) {
        $response = $this->request('GET', 'users', $user->toArray());

        if ($response->isSuccessful())
        {
            $user->fill((array) $response->getPayload());
            return $user;
        }

        return $response;
    }
}