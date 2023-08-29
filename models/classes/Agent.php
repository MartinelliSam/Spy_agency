<?php

class Agent
{
    private ?int $id = null;
    private string $lastName;
    private string $firstName;
    private string $birthdate;
    private int $identificationCode;
    private string $nationality;

    public function __construct(int $id, string $lastName, string $firstName, string $birthdate, int $identificationCode, 
                                string $nationality)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthdate = $birthdate;
        $this->identificationCode = $identificationCode;
        $this->nationality = $nationality;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getLastName(): string 
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName) 
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string 
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName) 
    {
        $this->firstName = $firstName;
    }

    public function getBirthDate(): string 
    {
        return $this->birthdate;
    }

    public function setBirthDate(string $birthdate) 
    {
        $this->birthdate = $birthdate;
    }

    public function getIdentificationCode(): int 
    {
        return $this->identificationCode;
    }

    public function setIdentificationCode(int $identificationCode) 
    {
        $this->identificationCode = $identificationCode;
    }

    public function getNationality(): string 
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality) 
    {
        $this->nationality = $nationality;
    }
}