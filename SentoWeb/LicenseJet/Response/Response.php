<?php namespace SentoWeb\LicenseJet\Response;

Use GuzzleHttp\Psr7\Response as HttpResponse;

Class Response {
    private $payload = null;
    private $httpResponse;

    static $STATUS_OK = 200;
    static $STATUS_NOT_CHANGED = 304;

    public function __construct($payload, HttpResponse $httpResponse = null)
    {
        $this->payload = $payload;

        $this->httpResponse = $httpResponse;

        if ($httpResponse && is_array($httpResponse->getHeader('Content-Type'))) {
            if (in_array('application/json', $httpResponse->getHeader('Content-Type'))) {
                $this->payload = json_decode($this->payload, true);
            }
        }
    }

    public function getErrorMessage() : ?string
    {
        if ($this->httpResponse) {
            return $this->httpResponse->getReasonPhrase();
        }
    }

    public function getPayload($default = []) : array
    {
        return $this->payload ?: $default;
    }

    public function getStatusCode() {
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