<?php

class MissionHideout
{
    private int $idMission;
    private int $idHideout;

    public function __construct(int $idMission, int $idHideout)
    {
        $this->idMission = $idMission;
        $this->idHideout = $idHideout;
    }

    public function getIdMission(): int 
    {
        return $this->idMission;
    }

    public function setIdMission(int $idMission) 
    {
        $this->idMission = $idMission;
    }

    public function getIdHideout(): int 
    {
        return $this->idHideout;
    }

    public function setIdHideout(int $idHideout) 
    {
        $this->idHideout = $idHideout;
    }
}