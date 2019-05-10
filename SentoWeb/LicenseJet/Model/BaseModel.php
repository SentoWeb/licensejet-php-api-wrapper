<?php namespace SentoWeb\LicenseJet\Model;

use DateTime;

Abstract class BaseModel
{
    protected $attributes;
    protected $originalAttributes;

    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    public function __construct(array $attributes = null)
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
     * @return static
     */
    public function fill(array $attributes) : BaseModel
    {
        $this->attributes = array_merge($this->attributes, array_map(function ($attributes) {
            return $attributes;
        }, $attributes));

        return $this;
    }

    public function __call($key, $value)
    {
        if (strpos($key, "set") === 0)
        {
            $key = str_replace("set", "", strtolower($key));

            $this->attributes[$key] = $value[0];
        }

        if (strpos($key, "get") === 0)
        {
            $key = str_replace("get", "", strtolower($key));

            return $this->attributes[$key];
        }
    }

    public function __get($key) {
        if (method_exists($this, 'get'.$key))
        {
            return call_user_func([$this, 'get'.$key], $this->attributes[$key]);
        }
        else
        {
            return $this->attributes[$key];
        }
    }

    public function hasChanges() : bool
    {
        return !empty($this->changes());
    }

    // @todo
    public function changes() : array
    {
        $changes = [];

        foreach ($this->attributes as $key => $value) {
            if (!isset($this->originalAttributes[$key]) || $this->originalAttributes[$key] != $value) {
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

    public function dotSet(array &$array, string $key, $value) : array
    {
        if (is_null($key))
        {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while (count($keys) > 1)
        {
            $key = array_shift($keys);

            if (! isset($array[$key]) || ! is_array($array[$key]))
            {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    public function getDateTimeOrNull($value) : ?DateTime
    {
        if (!$value)
        {
            return null;
        }

        return DateTime::createFromFormat($value, static::DATETIME_FORMAT);
    }

    public function link($name = 'self') : ?string
    {
        $links = $this->getAttribute('_links', []);

        if (isset($links->$name)) {
            return $links->$name;
        }

        return null;
    }
}