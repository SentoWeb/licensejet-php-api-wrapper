<?php

use SentoWeb\LicenseJet\Endpoint\ProjectEndpoint;
use SentoWeb\LicenseJet\Identity;

if (!function_exists('licensejet_get_projects')) {
    /**
     * @param $apiUrl
     * @param $licenseKey
     * @return \SentoWeb\LicenseJet\Collection\LicenseCollection
     */
    function licensejet_get_projects(string $apiUrl, string $licenseKey) : \SentoWeb\LicenseJet\Collection\LicenseCollection
    {
        $projects = new ProjectEndpoint(new Identity($apiUrl, $licenseKey));

        return $projects->projects()->get();
    }
}