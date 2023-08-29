<?php

require_once 'models/managers/MissionManager.php';
require_once 'models/managers/CountryManager.php';
require_once 'models/managers/SpecialityManager.php';
require_once 'models/managers/AgentManager.php';
require_once 'models/managers/HideoutManager.php';
require_once 'models/managers/TargetManager.php';
require_once 'models/managers/ContactManager.php';

class MissionController
{ 
    protected $missionManager;
    protected $countryManager;
    protected $specialityManager;
    protected $agentManager;
    protected $hideoutManager;
    protected $targetManager;
    protected $contactManager;

    public function __construct()
    {
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
        $missions = $this->missionManager->showMissionList();
        require_once 'views/mission/missionList.php';
    }

    public function editMission() 
    {
        $id = htmlspecialchars($_POST['idMission']);
        $mission = $this->missionManager->getMissionById($id);
        $missionTypes = $this->missionManager->showAllMissionTypes();
        $missionStatuses = $this->missionManager->showAllMissionStatuses();
        $countries = $this->countryManager->showCountryList();
        $specialities = $this->specialityManager->showSpecialityList();
        $agents = $this->agentManager->showAgentList();
        $contacts = $this->contactManager->showContactList();
        $hideouts = $this->hideoutManager->showHideoutList();
        $targets = $this->targetManager->showTargetList();
        require_once 'views/mission/editMission.php';
    }

    public function editMissionInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $this->missionManager->editMission($id);
        header('Location: '. BASE_URL . '/mission');
    }

    public function deleteMissionFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idMission']);
        $this->missionManager->deleteMission($id);
        header('Location: '. BASE_URL . '/mission');
    }

    public function addMission() 
    {
        $missionTypes = $this->missionManager->showAllMissionTypes();
        $missionStatuses = $this->missionManager->showAllMissionStatuses();
        $countries = $this->countryManager->showCountryList();
        $specialities = $this->specialityManager->showSpecialityList();
        $agents = $this->agentManager->showAgentList();
        $contacts = $this->contactManager->showContactList();
        $hideouts = $this->hideoutManager->showHideoutList();
        $targets = $this->targetManager->showTargetList();
        require_once 'views/mission/addMission.php';
    }

    public function missionAddedInDatabase() 
    {
        $this->missionManager->addMissionToDatabase();
        header('Location: '. BASE_URL . '/mission');
    }
}