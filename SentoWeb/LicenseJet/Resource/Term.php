<?php namespace SentoWeb\LicenseJet\Resource;

Class Term extends Resource
{
    public function getType() : ?string
    {
        return $this->getAttribute('type');
    }

    public function getLength() : int
    {
        return (int) $this->getAttribute('length') ?: 1;
    }
}