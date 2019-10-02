<?php namespace SentoWeb\LicenseJet\Resource;

use DateTime;

Abstract class Resource
{
    protected $attributes;
    protected $originalAttributes;

    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->originalAttributes = $attributes;
    }

    public function getId() : ?int
    {
        return $this->attributes['id'];
    }

    public function toArray() : array
    {
        return $this->attributes;
    }

    protected function getAttribute(string $name, $default = null)
    {
        return $this->dotGet($this->attributes, $name, $default);
    }

    protected function setAttribute(string $name, $value) : void
    {
        $this->attributes = $this->dotSet($this->attributes, $name, $value);
    }

    /**
     * @param array $attributes
     * @return self
     */
    public function fill(array $attributes) : self
    {
        $this->attributes = array_merge($this->attributes, array_map(function ($attributes) {
            return $attributes;
        }, $attributes));

        return $this;
    }

    public function hasChanges() : bool
    {
        return !empty($this->changes());
    }

    public function changes() : array
    {
        $changes = [];

        foreach ($this->attributes as $key => $value)
        {
            if (!isset($this->originalAttributes[$key]) || $this->originalAttributes[$key] != $value)
            {
                $changes[$key] = $value;
            }
        }

        return $changes;
    }

    public function dotGet(array $array, string $key, $default)
    {
        if (is_null($key))
        {
            return $array;
        }

        if (array_key_exists($key, $array))
        {
            return $array[$key];
        }

        if (strpos($key, '.') === false)
        {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment)
        {
            if (array_key_exists($segment, $array))
            {
                $array = $array[$segment];
            }
            else
            {
                return $default;
            }
        }

        return $array;
    }

    public function dotSet(array $array, string $key, $value) : array
    {
        $keys = explode('.', $key);
        $processed = 0;
        $data = &$array;

        foreach ($keys as $key)
        {
            $processed++;

            if (!isset($data[$key]) || !is_array($data[$key]))
            {
                $data[$key] = [];
            }

            $data = &$data[$key];
        }

        $data = $value;

        return $array;
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function createFromArray(array $attributes) : self
    {
        return new static($attributes);
    }

    public function getDateTimeOrNull($value) : ?DateTime
    {
        if (!$value)
        {
            return null;
        }

        $dateTime = DateTime::createFromFormat(static::DATETIME_FORMAT, $value);

        if ($dateTime)
        {
            return $dateTime;
        }

        return null;
    }

    public function link($name = 'self') : ?string
    {
        $links = $this->getAttribute('_links', []);

        if (isset($links->$name))
        {
            return $links->$name;
        }

        return null;
    }
}