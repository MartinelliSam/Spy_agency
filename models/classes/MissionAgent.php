<?php

class MissionAgent
{
    private int $idMission;
    private int $idAgent;

    public function __construct(int $idMission, int $idAgent)
    {
        $this->idMission = $idMission;
        $this->idAgent = $idAgent;
    }

    public function getIdMission(): int 
    {
        return $this->idMission;
    }

    public function setIdMission(int $idMission) 
    {
        $this->idMission = $idMission;
    }

    public function getIdAgent(): int
    {
        return $this->idAgent;
    }

    public function setIdAgent(int $idAgent) 
    {
        $this->idAgent = $idAgent;
    }
}