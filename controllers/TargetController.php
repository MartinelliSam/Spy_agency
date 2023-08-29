<?php

require_once 'models/managers/TargetManager.php';
require_once 'models/managers/NationalityManager.php';

class TargetController
{ 
    protected $targetManager;
    protected $nationalityManager;

    public function __construct()
    {
        $this->targetManager = new TargetManager;
        $this->nationalityManager = new NationalityManager;
    }

    public function index() 
    {
        $targets = $this->targetManager->showTargetList();
        require_once 'views/target/targetList.php';
    }

    public function addTarget() 
    {
        $nationalities = $this->nationalityManager->showNationalityList();
        require_once 'views/target/addTarget.php';
    }

    public function targetAddedToDatabase() 
    {
        $this->targetManager->addTargetToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/target');
    }

    public function deleteTargetFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idTarget']);
        $this->targetManager->deleteTarget($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/target');
    }

    public function editTarget() 
    {
        $id = htmlspecialchars($_POST['idTarget']);
        $target = $this->targetManager->getTargetById($id);
        $nationalities = $this->nationalityManager->showNationalityList();
        $targetNationality = $this->targetManager->showTargetNationality($id);
        require_once 'views/target/editTarget.php';
    }

    public function editTargetInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $birthdate = htmlspecialchars($_POST['birthdate']);
        $codeName = htmlspecialchars($_POST['codeName']);
        $idNationality = htmlspecialchars($_POST['idNationality']);
        $this->targetManager->editTarget($id, $lastName, $firstName, $birthdate, $codeName, $idNationality);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/target');
    }
}   