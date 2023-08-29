<?php

class Mission 
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private string $codeName;
    private string $beginsAt;
    private string $endsAt;
    private string $missionType;
    private string $missionStatus;
    private string $country;
    private string $speciality;

    public function __construct(int $id, string $title, string $description, string $codeName, string $beginsAt, 
                                string $endsAt, string $missionType, string $missionStatus, string $country, 
                                string $speciality)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->codeName = $codeName;
        $this->beginsAt = $beginsAt;
        $this->endsAt = $endsAt;
        $this->missionType = $missionType;
        $this->missionStatus = $missionStatus;
        $this->country = $country;
        $this->speciality = $speciality;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    public function setTitle(string $title) 
    {
        $this->title = $title;
    }

    public function getDescription(): string 
    {
        return $this->description;
    }

    public function setDescription(string $description) 
    {
        $this->description = $description;
    }

    public function getCodeName(): string 
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName) 
    {
        $this->codeName = $codeName;
    }

    public function getBeginsAt(): string 
    {
        return $this->beginsAt;
    }

    public function setBeginsAt(string $beginsAt) 
    {
        $this->beginsAt = $beginsAt;
    }

    public function getEndsAt(): string 
    {
        return $this->endsAt;
    }

    public function setEndsAt(string $endsAt) 
    {
        $this->endsAt = $endsAt;
    }

    public function getMissionType(): string 
    {
        return $this->missionType;
    } 

    public function setMissionType(string $missionType) 
    {
        $this->missionType = $missionType;
    }

    public function getMissionStatus(): string 
    {
        return $this->missionStatus;
    } 

    public function setMissionStatus(string $missionStatus) 
    {
        $this->missionStatus = $missionStatus;
    }

    public function getCountry(): string 
    {
        return $this->country;
    }

    public function setCountry(string $country) 
    {
        $this->country = $country;
    }
    
    public function getSpeciality(): string 
    {
        return $this->speciality;
    } 

    public function setSpeciality(string $speciality) 
    {
        $this->speciality = $speciality;
    }
}