<?php

require_once 'models/managers/SearchManager.php';
require_once 'models/managers/MissionManager.php';
require_once 'models/managers/CountryManager.php';
require_once 'models/managers/SpecialityManager.php';
require_once 'models/managers/AgentManager.php';
require_once 'models/managers/HideoutManager.php';
require_once 'models/managers/TargetManager.php';
require_once 'models/managers/ContactManager.php';

class SearchController
{
    private $searchManager;
    protected $missionManager;
    protected $countryManager;
    protected $specialityManager;
    protected $agentManager;
    protected $hideoutManager;
    protected $targetManager;
    protected $contactManager;

    public function __construct()
    {
        $this->searchManager = new SearchManager;
        $this->missionManager = new MissionManager;
        $this->countryManager = new CountryManager;
        $this->specialityManager = new SpecialityManager;
        $this->agentManager = new AgentManager;
        $this->hideoutManager = new HideoutManager;
        $this->targetManager = new TargetManager;
        $this->contactManager = new ContactManager;
    }

    public function index() 
    {
        $missions = $this->searchManager->search();
        require_once 'views/search/search.php';
    }
}