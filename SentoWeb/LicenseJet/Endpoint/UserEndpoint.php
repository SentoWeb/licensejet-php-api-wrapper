<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\LicenseJetException;
use SentoWeb\LicenseJet\Resource\User;
use SentoWeb\LicenseJet\Collection\UserCollection;
use SentoWeb\LicenseJet\RequestBuilder\CollectionRequestBuilder;

Class UserEndpoint extends Endpoint
{
    /**
     * Get user by ID.
     *
     * @param $userId
     * @return User
     * @throws LicenseJetException
     */
    public function get($userId) : User
    {
        $response = $this->request('GET', 'user/'.$userId);

        if ($response->isSuccessful())
        {
            return User::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to retrieve resource. Error: '.$response->getErrorMessage());
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
     * @return User
     * @throws LicenseJetException
     */
    public function create(User $user) : User
    {
        $response = $this->request('GET', 'users', $user->toArray());

        if ($response->isSuccessful())
        {
            return User::createFromArray((array) $response->getPayload());
        }

        throw new LicenseJetException('Failed to update resource. Error: '.$response->getErrorMessage());
    }
}