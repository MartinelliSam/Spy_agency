<?php

require_once 'models/managers/AgentManager.php';
require_once 'models/managers/NationalityManager.php';
require_once 'models/managers/SpecialityManager.php';

class AgentController
{
    protected $agentManager;
    protected $nationalityManager;
    protected $specialityManager;

    public function __construct()
    {
        $this->agentManager = new AgentManager;
        $this->nationalityManager = new NationalityManager;
        $this->specialityManager = new SpecialityManager;
    }

    public function index() 
    {
        $agents = $this->agentManager->showAgentList();
        require_once 'views/agent/agentList.php';
    }

    public function addAgent() 
    {
        $specialities = $this->specialityManager->showSpecialityList();
        $nationalities = $this->nationalityManager->showNationalityList();
        require_once 'views/agent/addAgent.php';
    }

    public function addAgentSpeciality() 
    {
        $specialities = $this->specialityManager->showSpecialityList();
        require_once 'views/agent/addAgentSpeciality.php';
    }

  
    public function agentAddedToDatabase() 
    {
        $this->agentManager->addAgentToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/agent');
    }

    public function editAgent() 
    {
        $id = htmlspecialchars($_POST['idAgent']);
        $agent = $this->agentManager->getAgentById($id);
        $nationalities = $this->nationalityManager->showNationalityList();
        $specialities = $this->specialityManager->showSpecialityList();
        require_once 'views/agent/editAgent.php';
    }

    public function editAgentInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $this->agentManager->editAgent($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/agent');
    }

    public function deleteAgentFromDatabase() 
    {
          $id = htmlspecialchars($_POST['idAgent']);
          $this->agentManager->deleteAgent($id);
          $_SESSION['alert'] = [
              "type" => "success",
              "msg" => "Suppression bien prise en compte"
          ];
          header('Location: '. BASE_URL . '/agent');
    }
}