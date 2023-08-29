<?php
session_start();

use models\Router;

// defining base path
define('BASE_URL', '/NomDossier');

require_once 'models/Router.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/LogoutController.php';
require_once 'controllers/CountryController.php';
require_once 'controllers/HideoutController.php';
require_once 'controllers/TargetController.php';
require_once 'controllers/NationalityController.php';
require_once 'controllers/AgentController.php';
require_once 'controllers/MissionController.php';
require_once 'controllers/ContactController.php';
require_once 'controllers/SpecialityController.php';
require_once 'controllers/SearchController.php';


// instantiating router
$router = new Router();

//defining routes
$router->addRoute('GET', BASE_URL . '/', 'HomeController', 'index');

// SEARCH ROUTE
$router->addRoute('POST', BASE_URL . '/search', 'SearchController', 'index');

// LOGIN ROUTES
$router->addRoute('GET', BASE_URL . '/login', 'LoginController', 'index');
$router->addRoute('POST', BASE_URL . '/login', 'LoginController', 'login');
$router->addRoute('GET', BASE_URL . '/logout', 'LogoutController', 'logout');

// COUNTRY ROUTES
$router->addRoute('GET', BASE_URL . '/country', 'CountryController', 'index');
$router->addRoute('GET', BASE_URL . '/country/add', 'CountryController', 'addCountry');
$router->addRoute('POST', BASE_URL . '/country/add', 'CountryController', 'countryAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/country/edit', 'CountryController', 'editCountry');
$router->addRoute('POST', BASE_URL . '/country/editOk', 'CountryController', 'editCountryInDatabase');
$router->addRoute('POST', BASE_URL . '/country', 'CountryController', 'deleteCountryFromDatabase');

// NATIONALITY ROUTES
$router->addRoute('GET', BASE_URL . '/nationality', 'NationalityController', 'index');
$router->addRoute('GET', BASE_URL . '/nationality/add', 'NationalityController', 'addNationality');
$router->addRoute('POST', BASE_URL . '/nationality/add', 'NationalityController', 'nationalityAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/nationality/edit', 'NationalityController', 'editNationality');
$router->addRoute('POST', BASE_URL . '/nationality/editOk', 'NationalityController', 'editNationalityInDatabase');
$router->addRoute('POST', BASE_URL . '/nationality', 'NationalityController', 'deleteNationalityFromDatabase');

// HIDEOUT ROUTES
$router->addRoute('GET', BASE_URL . '/hideout', 'HideoutController', 'index');
$router->addRoute('GET', BASE_URL . '/hideout/add', 'HideoutController', 'addHideout');
$router->addRoute('POST', BASE_URL . '/hideout/add', 'HideoutController', 'hideoutAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/hideout/edit', 'HideoutController', 'editHideout');
$router->addRoute('POST', BASE_URL . '/hideout/editOk', 'HideoutController', 'editHideoutInDatabase');
$router->addRoute('POST', BASE_URL . '/hideout', 'HideoutController', 'deleteHideoutFromDatabase');

// TARGET ROUTES
$router->addRoute('GET', BASE_URL . '/target', 'TargetController', 'index');
$router->addRoute('GET', BASE_URL . '/target/add', 'TargetController', 'addTarget');
$router->addRoute('POST', BASE_URL . '/target/add', 'TargetController', 'targetAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/target/edit', 'TargetController', 'editTarget');
$router->addRoute('POST', BASE_URL . '/target/editOk', 'TargetController', 'editTargetInDatabase');
$router->addRoute('POST', BASE_URL . '/target', 'TargetController', 'deleteTargetFromDatabase');

// CONTACT ROUTES 
$router->addRoute('GET', BASE_URL . '/contact', 'ContactController', 'index');
$router->addRoute('GET', BASE_URL . '/contact/add', 'ContactController', 'addContact');
$router->addRoute('POST', BASE_URL . '/contact/add', 'ContactController', 'contactAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/contact/edit', 'ContactController', 'editContact');
$router->addRoute('POST', BASE_URL . '/contact/editOk', 'ContactController', 'editContactInDatabase');
$router->addRoute('POST', BASE_URL . '/contact', 'ContactController', 'deleteContactFromDatabase');

// AGENT ROUTES
$router->addRoute('GET', BASE_URL . '/agent', 'AgentController', 'index');
$router->addRoute('GET', BASE_URL . '/agent/add', 'AgentController', 'addAgent');
$router->addRoute('POST', BASE_URL . '/agent/add', 'AgentController', 'agentAddedToDatabase');
$router->addRoute('POST', BASE_URL . '/agent/edit', 'AgentController', 'editAgent');
$router->addRoute('POST', BASE_URL . '/agent/editOk', 'AgentController', 'editAgentInDatabase');
$router->addRoute('POST', BASE_URL . '/agent', 'AgentController', 'deleteAgentFromDatabase');

// MISSION ROUTES
$router->addRoute('GET', BASE_URL . '/mission', 'MissionController', 'index');
$router->addRoute('GET', BASE_URL . '/mission/add', 'MissionController', 'addMission');
$router->addRoute('POST', BASE_URL . '/mission/add', 'MissionController', 'missionAddedInDatabase');
$router->addRoute('POST', BASE_URL . '/mission/edit', 'MissionController', 'editMission');
$router->addRoute('POST', BASE_URL . '/mission/editOk', 'MissionController', 'editMissionInDatabase');
$router->addRoute('POST', BASE_URL . '/mission', 'MissionController', 'deleteMissionFromDatabase');

// SPECIALITY ROUTES
$router->addRoute('GET', BASE_URL . '/speciality', 'SpecialityController', 'index');
$router->addRoute('GET', BASE_URL . '/speciality/add', 'SpecialityController', 'addSpeciality');
$router->addRoute('POST', BASE_URL . '/speciality/add', 'SpecialityController', 'specialityAddedInDatabase');
$router->addRoute('POST', BASE_URL . '/speciality/edit', 'SpecialityController', 'editSpeciality');
$router->addRoute('POST', BASE_URL . '/speciality/editOk', 'SpecialityController', 'editSpecialityInDatabase');
$router->addRoute('POST', BASE_URL . '/speciality', 'SpecialityController', 'deleteSpecialityFromDatabase');

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$handler = $router->getHandler($method, $uri);

if ($handler == null) {

    header('HTTP/1.1 404 not found');
    exit();

}

// calling controller 
$controller = new $handler['controller']();
$action = $handler['action'];
$controller->$action();
