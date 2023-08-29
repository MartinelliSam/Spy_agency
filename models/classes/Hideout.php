<?php

class Hideout
{
    private ?int $id = null;
    private int $code;
    private string $address;
    private string $type;
    private string $country;

    public function __construct(int $id, int $code, string $address, string $type, string $country)
    {
        $this->id = $id;
        $this->code = $code;
        $this->address = $address;
        $this->type = $type;
        $this->country = $country;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getCode(): int 
    {
        return $this->code;
    }

    public function setCode(int $code) 
    {
        $this->code = $code;
    }

    public function getAddress(): string 
    {
        return $this->address;
    }

    public function setAdress(string $address) 
    {
        $this->address = $address;
    }
    
    public function getType(): string 
    {
        return $this->type;
    }

    public function setType(string $type) 
    {
        $this->type = $type;
    }

    public function getCountry(): string 
    {
        return $this->country;
    }

    public function setCountry(string $country) 
    {
        $this->country = $country;
    }
}