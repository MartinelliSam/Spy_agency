<?php

class MissionTarget
{
    private int $idMission;
    private int $idTarget;

    public function __construct(int $idMission, int $idTarget)
    {
        $this->idMission = $idMission;
        $this->idTarget = $idTarget;
    }

    public function getIdMission(): int 
    {
        return $this->idMission;
    }

    public function setIdMission(int $idMission) 
    {
        $this->idMission = $idMission;
    }

    public function getIdTarget(): int 
    {
        return $this->idTarget;
    }

    public function setIdTarget(int $idTarget) 
    {
        $this->idTarget = $idTarget;
    }
}