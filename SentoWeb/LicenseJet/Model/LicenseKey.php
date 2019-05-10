<?php namespace SentoWeb\LicenseJet\Model;

use DateTime;

Class LicenseKey extends BaseModel {
    public function getLicenseId() : ?string
    {
        return $this->getAttribute('license_id');
    }

    public function getHost() : ?string
    {
        return $this->getAttribute('url');
    }

    public function getKey() : ?string
    {
        return $this->getAttribute('key');
    }

    public function getStatus() : ?int
    {
        if (is_null($this->getAttribute('status')))
        {
            return null;
        }

        return (int) $this->getAttribute('status');
    }

    public function getStatusName() : ?string
    {
        return $this->getAttribute('status_name');
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('created_date'));
    }
}