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

    public function setExpirationDate(?DateTime $dateTime) : void
    {
        if ($dateTime)
        {
            $this->setAttribute('expiration_date', $dateTime->format(static::DATETIME_FORMAT));
        }
        else
        {
            $this->setAttribute('expiration_date', null);
        }
    }

    public function isTansferable() : bool
    {
        return $this->getAttribute('transferable') == 1;
    }

    public function setTransferable(bool $transferable) : void
    {
        $this->setAttribute('transferable', $transferable);
    }

    public function isTransferReady() : bool
    {
        return (bool) $this->getAttribute('transfer_ready');
    }

    public function getTransferableDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('transferable_date'));
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

    public function getLicensingPlanId() : ?int
    {
        if (is_null($this->getAttribute('licensing_plan_id')))
        {
            return null;
        }

        return (int) $this->getAttribute('licensing_plan_id');
    }

    public function setLicensingPlanId(int $licensingPlanId) : void
    {
        $this->setAttribute('licensing_plan_id', $licensingPlanId);
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
        return $this->getAttribute('project_identifier');
    }

    public function getCreatedDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('created_date'));
    }

    public function getUpdateAccessRestrictions() : ?array
    {
        if (!is_array($this->getAttribute('update_access_restrictions')))
        {
            return null;
        }

        return $this->getAttribute('update_access_restrictions');
    }

    public function setUpdateAccessRestrictions(?array $restrictions)
    {
        $this->setAttribute('update_access_restrictions', $restrictions);
    }

    public function getUpdateAccessExpirationDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('update_access_expiration_date'));
    }

    public function setUpdateAccessExpirationDate(?DateTime $dateTime)
    {
        if ($dateTime)
        {
            $this->setAttribute('update_access_expiration_date', $dateTime->format(static::DATETIME_FORMAT));
        }
        else
        {
            $this->setAttribute('update_access_expiration_date', null);
        }
    }

    public function getUpdateAccessExpirationTerm() : ?Term
    {
        return Term::create(
            $this->getAttribute('update_access_expiration_term.identifier'),
            $this->getAttribute('update_access_expiration_term.length'));
    }

    public function setUpdateAccessExpirationTerm(Term $updateAccessExpirationTerm) : void
    {
        $this->setAttribute('update_access_expiration_term.identifier', $updateAccessExpirationTerm->getIdentifier());
        $this->setAttribute('update_access_expiration_term.length', $updateAccessExpirationTerm->getLength());
    }

    public function getUpdateAccessExpirationVersion() : ?string
    {
        return $this->getAttribute('update_access_expiration_version');
    }

    public function setUpdateAccessExpirationVersion(?string $version)
    {
        $this->setAttribute('update_access_expiration_version', $version);
    }

    public function getSuspensionExpirationDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('suspension_expiration_date'));
    }

    public function getSuspensionReason() : ?string
    {
        return $this->getAttribute('suspension_reason');
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