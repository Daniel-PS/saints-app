<?php

namespace App;

class User
{
    public function __construct(private string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
