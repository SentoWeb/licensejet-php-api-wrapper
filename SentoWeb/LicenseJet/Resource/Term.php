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

    public function getSingularName() : ?string
    {
        return $this->getAttribute('name.singular');
    }

    public function getPluralName() : ?string
    {
        return $this->getAttribute('name.plural');
    }
}