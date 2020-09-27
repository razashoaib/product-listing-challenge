<?php

namespace App\Http\Responses;

use ReflectionException;
use ReflectionProperty;

abstract class BaseResponse
{
    /**
     * @param $property
     * @return $this
     * @throws ReflectionException
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            try {
                $reflection = new ReflectionProperty($this, $property);
                $reflection->setAccessible($property);
                return $reflection->getValue($this);
            } catch (ReflectionException $e) {
                throw new ReflectionException($e->getMessage());
            }
        }
        return $this;
    }

    /**
     * @param $property
     * @param $value
     * @return $this
     * @throws ReflectionException
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            try {
                $reflection = new ReflectionProperty($this, $property);
                $reflection->setAccessible($property);
                $reflection->setValue($this, $value);
            } catch (ReflectionException $e) {
                throw new ReflectionException($e->getMessage());
            }
        }
        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        $getter = 'get' . ucfirst($name);
        return method_exists($this, $getter) && !is_null($this->$getter());
    }
}
