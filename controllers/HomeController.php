<?php

require_once 'models/managers/MissionManager.php';
require_once 'models/managers/CountryManager.php';
require_once 'models/managers/AgentManager.php';
require_once 'models/managers/TargetManager.php';

class HomeController
{
    private $missionManager;
    protected $countryManager;
    protected $agentManager;
    protected $targetManager;

    public function __construct()
    {
        $this->missionManager = new MissionManager;
        $this->countryManager = new CountryManager;
        $this->agentManager = new AgentManager;
        $this->targetManager = new TargetManager;
    }

    public function index() 
    {
        $missions = $this->missionManager->showMissionList();
        $countries = $this->countryManager->showCountryList();
        $agents = $this->agentManager->showAgentList();
        $targets = $this->targetManager->showTargetList();
        require_once 'views/global/home.php';
    }
}