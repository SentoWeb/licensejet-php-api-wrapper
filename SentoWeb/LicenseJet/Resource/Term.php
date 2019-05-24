<?php namespace SentoWeb\LicenseJet\Resource;

Class Term extends Resource
{
    public function getIdentifier() : ?string
    {
        return $this->getAttribute('identifier');
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

    public static function create(?string $identifier, ?int $length) : Term
    {
        return new static([
            'identifier' => $identifier,
            'length' => $length
        ]);
    }
}