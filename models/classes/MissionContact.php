<?php

class MissionContact
{
    private int $idMission;
    private int $idContact;

    public function __construct(int $idMission, int $idContact)
    {
        $this->idMission = $idMission;
        $this->idContact = $idContact;
    }

    public function getIdMission(): int 
    {
        return $this->idMission;
    }

    public function setIdMission(int $idMission) 
    {
        $this->idMission = $idMission;
    }

    public function getIdContact(): int 
    {
        return $this->idContact;
    }

    public function setIdContact(int $idContact) 
    {
        $this->idContact = $idContact;
    }
}