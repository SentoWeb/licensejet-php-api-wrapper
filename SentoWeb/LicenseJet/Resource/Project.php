<?php namespace SentoWeb\LicenseJet\Resource;

Class Project extends Resource
{
    public function getIdentifier() : ?string
    {
        return $this->getAttribute('identifier');
    }

    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    public function getStableVersion() : ?string
    {
        return $this->getAttribute('stable_version');
    }

    public function getManager() : ?string
    {
        return $this->getAttribute('manager');
    }

    public function getManagerName() : ?string
    {
        return $this->getAttribute('manager_name');
    }
}