<?php namespace SentoWeb\LicenseJet\Resource;

use DateTime;

Class License extends Resource
{
    /**
     * Get License Type.
     *
     * @return null|string
     */
    public function getType() : ?string
    {
        return $this->getAttribute('type');
    }

    public function setType(string $type) : void
    {
        $this->setAttribute('type', $type);
    }

    public function getSubscriptionTerm() : ?Term
    {
        if (!$this->isSubscription())
        {
            return null;
        }

        return Term::create(
            $this->getAttribute('subscription_term.identifier'),
            $this->getAttribute('subscription_term.length'));
    }

    public function setSubscriptionTerm(Term $term) : void
    {
        $this->setAttribute('subscription_term', $term->toArray());
    }

    public function getAccessKey() : ?string
    {
        return $this->getAttribute('access_key');
    }

    public function setAccessKey(string $accessKey) : void
    {
        $this->setAttribute('access_key', $accessKey);
    }

    public function getStatus() : ?string
    {
        return $this->getAttribute('status');
    }

    public function setStatus(string $status) : void
    {
        $this->setAttribute('status', $status);
    }

    public function getKeyLimit() : ?int
    {
        if (is_null($this->getAttribute('key_limit')))
        {
            return null;
        }

        return (int) $this->getAttribute('key_limit');
    }

    public function setKeyLimit(?int $keyLimit) : void
    {
        $this->setAttribute('key_limit', $keyLimit);
    }

    public function getExpirationDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('expiration_date'));
    }

    public function setExpirationDate(DateTime $dateTime) : void
    {
        $this->setAttribute('expiration_date', $dateTime->format(static::DATETIME_FORMAT));
    }

    public function isTansferable() : bool
    {
        return $this->getAttribute('transferable') == 1;
    }

    public function setTransferable(bool $transferable) : void
    {
        $this->setAttribute('transferable', $transferable);
    }

    public function getTransferableDate() : ?DateTime
    {
        return $this->getDateTimeOrNull('transferable_date');
    }

    public function setTransferableDate(DateTime $dateTime) : void
    {
        $this->setAttribute('transferable_date', $dateTime->format(static::DATETIME_FORMAT));
    }

    public function getUserId() : ?int
    {
        if (is_null($this->getAttribute('user_id')))
        {
            return null;
        }

        return (int) $this->getAttribute('user_id');
    }

    public function setUserId(?int $userId) : void
    {
        $this->setAttribute('user_id', $userId);
    }

    public function getLicensingAgreementId() : ?int
    {
        if (is_null($this->getAttribute('licensing_agreement_id')))
        {
            return null;
        }

        return (int) $this->getAttribute('licensing_agreement_id');
    }

    public function setLicensingAgreementId(int $licensingAgreementId) : void
    {
        $this->setAttribute('licensing_agreement_id', $licensingAgreementId);
    }

    public function getProjectId() : ?int
    {
        if (is_null($this->getAttribute('project_id')))
        {
           return null;
        }

        return (int) $this->getAttribute('project_id');
    }

    public function getProjectIdentifier() : ?string
    {
        return $this->getAttribute('project.identifier');
    }

    public function getCreatedDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('created_date'));
    }

    public function isSubscription() : bool
    {
        return $this->getType() == 'subscription';
    }

    public function isPerpetual() : bool
    {
        return $this->getType() == 'perpetual';
    }

    public function isActive()
    {
        return $this->getStatus() == 'active';
    }

    public function isExpired()
    {
        return $this->getStatus() == 'expired';
    }

    public function isSuspended()
    {
        return $this->getStatus() == 'suspended';
    }
}