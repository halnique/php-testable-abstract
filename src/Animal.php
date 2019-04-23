<?php

namespace App;


abstract class Animal
{
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return static
     */
    public static function of(string $name): self
    {
        return new static($name);
    }
}
