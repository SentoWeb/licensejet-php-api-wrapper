<?php namespace SentoWeb\LicenseJet\Collection;

use SentoWeb\LicenseJet\Model\Project;

Class ProjectCollection extends BaseCollection {
    /**
     * @return Project[]
     */
    public function get() : array
    {
        return parent::get();
    }
}