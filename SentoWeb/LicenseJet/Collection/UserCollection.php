<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\Model\User;

Class UserCollection extends BaseCollection {
    /**
     * @return User[]
     */
    public function get() : array
    {
        return parent::get();
    }
}