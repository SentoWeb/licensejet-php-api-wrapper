<?php namespace SentoWeb\LicenseJet\Model;

Class ProjectOption extends BaseModel {
    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    public function getIdentifier() : ?string
    {
        return $this->getAttribute('identifier');
    }

    public function getDefaultValue() : ?string
    {
        return $this->getAttribute('default_value');
    }

    public function getType() : ?string
    {
        return $this->getAttribute('type');
    }
}