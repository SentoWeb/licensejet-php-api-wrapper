<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\Resource\User;

Class UserCollection extends BaseCollection {
    /**
     * @return User[]
     */
    public function get() : array
    {
        return parent::get();
    }
}