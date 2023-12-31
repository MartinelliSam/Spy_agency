<?php

class Country
{
    private ?int $id = null;
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function setName(string $name) 
    {
        $this->name = $name;
    }
}