<?php

require_once 'models/managers/CountryManager.php';

class CountryController
{ 
    protected $countryManager;

    public function __construct()
    {
        $this->countryManager = new CountryManager;
    }

    public function index() 
    {
        $countries = $this->countryManager->showCountryList();
        require_once 'views/country/countryList.php';
    }

    public function addCountry() 
    {
        require_once 'views/country/addCountry.php';
    }

    public function editCountry() 
    {
        require_once 'views/country/editCountry.php';
    }

    public function countryAddedToDatabase() 
    {
        $this->countryManager->addCountryToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];
        header('Location: '. BASE_URL . '/country');
    }

    public function deleteCountryFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idCountry']);
        $this->countryManager->deleteCountry($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/country');
    }

    public function editCountryInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $this->countryManager->editCountry($id, $name);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/country');
    }
}   