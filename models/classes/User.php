<?php

class User 
{
    private ?int $id = null;
    private string $lastName;
    private string $firstName;
    private string $email;
    private string $password;
    private DateTimeInterface $createdAt;
    private array $role = [];

    public function __construct(string $lastName, string $firstName, string $email, string $password)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTime('now');
        $this->role = [];
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

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function setEmail(string $email) 
    {
        $this->email = $email;
    }

    public function getPassword(): string 
    {
        return $this->password;
    }

    public function setPassword(string $password) 
    {
        $this->password = $password;
    }

    public function getCreatedAt(): DateTime 
    {
        return $this->createdAt;
    }

    public function getRole(): array 
    {
        return $this->role;
    }

    public function setRole(array $role) 
    {
        $this->role = $role;
    }
}