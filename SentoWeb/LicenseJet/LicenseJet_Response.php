<?php namespace SentoWeb\LicenseJet;

use Psr\Http\Message\ResponseInterface;

Class LicenseJet_Response
{
    private $payload = null;
    private $httpResponse;

    static $STATUS_OK = 200;

    static $STATUS_NOT_CHANGED = 304;

    public function __construct(ResponseInterface $httpResponse)
    {
        $this->payload = $httpResponse->getBody()->getContents();

        $this->httpResponse = $httpResponse;

        // Process JSON
        if ($httpResponse && is_array($httpResponse->getHeader('Content-Type')))
        {
            if (in_array('application/json', $httpResponse->getHeader('Content-Type')))
            {
                $this->payload = json_decode($this->payload, true);
            }
        }
    }

    public function getErrorMessage() : ?string
    {
        if ($this->httpResponse)
        {
            return $this->httpResponse->getReasonPhrase();
        }

        return null;
    }

    public function getPayload($default = [])
    {
        return $this->payload ?: $default;
    }

    public function getStatusCode()
    {
        return $this->httpResponse ? $this->httpResponse->getStatusCode() : null;
    }

    public function getContents()
    {
        return $this->payload;
    }

    public function isSuccessful() : bool
    {
        return in_array($this->getStatusCode(), [static::$STATUS_OK, static::$STATUS_NOT_CHANGED]);
    }
}