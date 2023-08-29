<?php

class Target 
{
    private ?int $id = null;
    private string $lastName;
    private string $firstName;
    private string $birthdate;
    private string $codeName;
    private string $nationality;

    public function __construct(int $id, string $lastName, string $firstName, string $birthdate, string $codeName, 
                                string $nationality)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthdate = $birthdate;
        $this->codeName = $codeName;
        $this->nationality = $nationality;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getlastName(): string 
    {
        return $this->lastName;
    }

    public function setlastName(string $lastName) 
    {
        $this->lastName = $lastName;
    }

    public function getfirstName(): string 
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName) 
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

    public function getCodeName(): string 
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName) 
    {
        $this->codeName = $codeName;
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