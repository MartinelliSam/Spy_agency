<?php

require_once 'models/managers/HideoutManager.php';
require_once 'models/managers/CountryManager.php';

class HideoutController
{ 
    protected $hideoutManager;
    protected $countryManager;

    public function __construct()
    {
        $this->hideoutManager = new HideoutManager;
        $this->countryManager = new CountryManager;
    }

    public function index() 
    {
        $hideouts = $this->hideoutManager->showHideoutList();
        require_once 'views/hideout/hideoutList.php';
    }

    public function addHideout() 
    {
        $countries = $this->countryManager->showCountryList();
        require_once 'views/hideout/addHideout.php';
    }

    public function editHideout() 
    {
        $id = htmlspecialchars($_POST['idHideout']);
        $hideout = $this->hideoutManager->getHideoutById($id);
        $hideoutCountry = $this->hideoutManager->showHideoutCountry($id);
        $countries = $this->countryManager->showCountryList();
        require_once 'views/hideout/editHideout.php';
    }

    public function hideoutAddedToDatabase() 
    {
        $this->hideoutManager->addHideoutToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/hideout');
    }

    public function deleteHideoutFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idHideout']);
        $this->hideoutManager->deleteHideout($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/hideout');
    }

    public function editHideoutInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $code = htmlspecialchars($_POST['code']);
        $address = htmlspecialchars($_POST['address']);
        $type = htmlspecialchars($_POST['type']);
        $idCountry = htmlspecialchars($_POST['idCountry']);
        $this->hideoutManager->editHideout($id, $code, $address, $type, $idCountry);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/hideout');
    }
}   