<?php

require_once 'models/managers/NationalityManager.php';

class NationalityController
{ 
    protected $nationalityManager;

    public function __construct()
    {
        $this->nationalityManager = new NationalityManager;
    }

    public function index() 
    {
        $nationalities = $this->nationalityManager->showNationalityList();
        require_once 'views/nationality/nationalityList.php';
    }

    public function addNationality() 
    {
        require_once 'views/nationality/addNationality.php';
    }

    public function editNationality() 
    {
        require_once 'views/nationality/editNationality.php';
    }

    public function nationalityAddedToDatabase() 
    {
        $this->nationalityManager->addNationalityToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/nationality');
    }

    public function deleteNationalityFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idNationality']);
        $this->nationalityManager->deleteNationality($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/nationality');
    }

    public function editNationalityInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $this->nationalityManager->editNationality($id, $name);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/nationality');
    }
}   

