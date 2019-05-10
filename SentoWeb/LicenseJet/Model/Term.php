<?php namespace SentoWeb\LicenseJet\Model;

Class Term extends BaseModel
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