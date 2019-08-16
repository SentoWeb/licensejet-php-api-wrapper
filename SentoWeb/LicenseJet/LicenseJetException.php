<?php namespace SentoWeb\LicenseJet;

use GuzzleHttp\Exception\ClientException;

Class LicenseJetException extends \Exception
{
    public function isNotFound() : ?bool
    {
        $previous = $this->getPrevious();

        if ($previous instanceof $this)
        {
            return $previous->isNotFound();
        }

        if ($previous instanceof ClientException)
        {
            return $previous->getResponse()->getStatusCode() == 404;
        }

        return null;
    }
}