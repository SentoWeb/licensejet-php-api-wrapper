<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\Resource\Project;

Class ProjectCollection extends BaseCollection {
    /**
     * @return Project[]
     */
    public function get() : array
    {
        return parent::get();
    }
}