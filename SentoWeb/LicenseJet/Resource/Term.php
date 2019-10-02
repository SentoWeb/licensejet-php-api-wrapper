<?php namespace SentoWeb\LicenseJet\Resource;

Class Term extends Resource
{
    public function getIdentifier() : ?string
    {
        return $this->getAttribute('identifier');
    }

    public function getLength() : ?int
    {
        return $this->getAttribute('length');
    }

    public function getEstimatedMinutes() : ?int
    {
        return $this->getAttribute('length_estimate.minutes');
    }

    public function getEstimatedHours() : ?int
    {
        return $this->getAttribute('length_estimate.hours');
    }

    public function getEstimatedDays() : ?int
    {
        return $this->getAttribute('length_estimate.days');
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