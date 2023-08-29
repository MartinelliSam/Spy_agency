<?php

require_once 'models/managers/ContactManager.php';
require_once 'models/managers/NationalityManager.php';

class ContactController
{
    protected $contactManager;
    protected $nationalityManager;

    public function __construct()
    {
        $this->contactManager = new ContactManager;
        $this->nationalityManager = new NationalityManager;
    }

    public function index() 
    {
        $contacts = $this->contactManager->showContactList();
        require_once 'views/contact/contactList.php';
    }

    public function addContact() 
    {
        $nationalities = $this->nationalityManager->showNationalityList();
        require_once 'views/contact/addContact.php';
    }

    public function contactAddedToDatabase() 
    {
        $this->contactManager->addContactToDatabase();
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout bien pris en compte"
        ];

        $_SESSION['error'] = [
            "type" => "error",
            "msg" => "Contact déjà ajouté"
        ];
        header('Location: '. BASE_URL . '/contact');
    }

    public function editContact() 
    {
        $id = htmlspecialchars($_POST['idContact']);
        $contact = $this->contactManager->getContactById($id);
        $nationalities = $this->nationalityManager->showNationalityList();
        require_once 'views/contact/editContact.php';
    }

    public function editContactInDatabase() 
    {
        $id = htmlspecialchars($_POST['id']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $birthdate = htmlspecialchars($_POST['birthdate']);
        $identificationCode = htmlspecialchars($_POST['identificationCode']);
        $idNationality = htmlspecialchars($_POST['idNationality']);
        $this->contactManager->editContact($id, $lastName, $firstName, $birthdate, $identificationCode, $idNationality);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification bien prise en compte"
        ];
        header('Location: '. BASE_URL . '/contact');
    }


    public function deleteContactFromDatabase() 
    {
        $id = htmlspecialchars($_POST['idContact']);
        $this->contactManager->deleteContact($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression bien prise en compte"
        ];
        header('Location: ' . BASE_URL . '/contact');
    }
}