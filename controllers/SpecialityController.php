<?php

require_once 'models/managers/SpecialityManager.php';

class SpecialityController
{ 
    protected $specialityManager;

    public function __construct()
    {
        $this->specialityManager = new SpecialityManager;
    }

    public function index() 
    {
        $specialities = $this->specialityManager->showSpecialityList();
        require_once 'views/speciality/specialityList.php';
    }

    public function addSpeciality() 
    {
        require_once 'views/speciality/addSpeciality.php';
    }

    public function editSpeciality() 
    {
        $id = htmlspecialchars($_POST['idSpeciality']);
        $speciality = $this->specialityManager->getSpecialityById($id);
        require_once 'views/speciality/editSpeciality.php';
    }

    public function specialityAddedInDatabase() 
    {
        $this->specialityManager->addSpecialityToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/speciality');
    }

    public function editSpecialityInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $this->specialityManager->editSpeciality($id, $name, $description);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/speciality');
    }

    public function deleteSpecialityFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idSpeciality']);
        $this->specialityManager->deleteSpeciality($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/speciality');
    }
}   