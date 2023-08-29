<?php

class AgentSpeciality
{
    private int $idAgent;
    private int $idSpeciality;

    public function __construct(int $idAgent, int $idSpeciality)
    {
        $this->idAgent = $idAgent;
        $this->idSpeciality = $idSpeciality;
    }

    public function getIdAgent(): int 
    {
        return $this->idAgent;
    }

    public function setIdAgent(int $idAgent) 
    {
        $this->idAgent = $idAgent;
    }

    public function getIdSpeciality(): int 
    {
        return $this->idSpeciality;
    }

    public function setIdSpeciality(int $idSpeciality) 
    {
        $this->idSpeciality = $idSpeciality;
    }
}