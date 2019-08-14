<?php namespace SentoWeb\LicenseJet\Resource;

use DateTime;

Class LicenseKey extends Resource
{
    public function getLicenseId() : ?int
    {
        if (is_null($this->getAttribute('license_id')))
        {
            return null;
        }

        return (int) $this->getAttribute('license_id');
    }

    public function setLicenseId(int $licenseId)
    {
        $this->setAttribute('license_id', $licenseId);
    }

    public function getHost() : ?string
    {
        return $this->getAttribute('host');
    }

    public function setHost(?string $host)
    {
        $this->setAttribute('host', $host);
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