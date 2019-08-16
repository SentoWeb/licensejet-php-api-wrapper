<?php namespace SentoWeb\LicenseJet\Resource;

use DateTime;

Class LicensingAgreement extends Resource
{
    /**
     * Get unique identifier
     *
     * @return string
     */
    public function getIdentifier() : ?string
    {
        return $this->getAttribute('identifier');
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() : ?string
    {
        return $this->getAttribute('type');
    }

    public function getText() : ?string
    {
        return $this->getAttribute('text');
    }

    public function getTransferLock() : bool
    {
        return $this->getAttribute('license_transfer_lock');
    }

    public function getProjectIdentifier() : ?string
    {
        return $this->getAttribute('project_identifier');
    }

    public function getProjectId() : ?int
    {
        if (is_null($this->getAttribute('project_id')))
        {
            return null;
        }

        return (int) $this->getAttribute('project_id');
    }

    public function getProjectName() : ?string
    {
        return $this->getAttribute('project.name');
    }

    public function getSubscriptionTerm() : ?Term
    {
        if (!$this->isSubscription())
        {
            return null;
        }

        return Term::create(
            $this->getAttribute('subscription_term.identifier'),
            $this->getAttribute('subscription_term.length')
        );
    }

    public function getTransferRestrictionTerm() : ?Term
    {
        if (!$this->isSubscription())
        {
            return null;
        }

        return Term::create(
            $this->getAttribute('transfer_restriction_term.identifier'),
            $this->getAttribute('transfer_restriction_term.length')
        );
    }

    public function isSubscription() : bool
    {
        return $this->getType() == 'subscription';
    }

    public function isPerpetual() : bool
    {
        return $this->getType() == 'perpetual';
    }

    public function getCreatedDate() : ?DateTime
    {
        return $this->getDateTimeOrNull($this->getAttribute('created_date'));
    }
}