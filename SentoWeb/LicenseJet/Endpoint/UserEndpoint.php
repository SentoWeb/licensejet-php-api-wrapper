<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Model\User;
use SentoWeb\LicenseJet\Collection\UserCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class UserEndpoint extends Endpoint {
    /**
     * Get user by ID.
     *
     * @param $user_id
     * @return bool|User
     */
    public function user($user_id) {
        $response = $this->get('user/'.$user_id, []);

        if ($response->isSuccessful()) {
            return new User((array) $response->getPayload());
        }

        return false;
    }

    /**
     * @return CollectionRequestBuilder
     */
    public function users() {
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
     * @return bool|User
     */
    public function create(User $user) {
        $response = $this->post('users', $user->toArray());

        if ($response->isSuccessful()) {
            $user->fill((array) $response->getPayload());
            return $user;
        }

        return false;
    }
}