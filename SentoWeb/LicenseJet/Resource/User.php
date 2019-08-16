<?php namespace SentoWeb\LicenseJet\Resource;

Class User extends Resource
{
    /**
     * Get the email of the user.
     *
     * @return mixed|null
     */
    public function getEmail() : ?string
    {
        return $this->getAttribute('email');
    }

    public function setEmail(string $email) : void
    {
        $this->setAttribute('email', $email);
    }

    public function getName() : ?string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name) : void
    {
        $this->setAttribute('name', $name);
    }

    public function getAuthentication() : bool
    {
        return $this->getAttribute('authentication') == 1;
    }

    public function setAuthentication(bool $authentication) : void
    {
        $this->setAttribute('authentication', $authentication);
    }

    public function setPassword(string $password) : void
    {
        $this->setAttribute('password', $password);
    }
}