<?php

require_once 'models/Model.php';
require_once 'models/classes/Mission.php';
require_once 'models/managers/CountryManager.php';
require_once 'models/managers/TargetManager.php';
require_once 'models/managers/AgentManager.php';
require_once 'models/managers/ContactManager.php';
require_once 'models/managers/HideoutManager.php';

class MissionManager extends Model 
{
    private $countryManager;
    private $targetManager;
    private $agentManager;
    private $contactManager;
    private $hideoutManager;

    public function __construct()
    {
        $this->countryManager = new CountryManager;
        $this->targetManager = new TargetManager;
        $this->agentManager = new AgentManager;
        $this->contactManager = new ContactManager;
        $this->hideoutManager = new HideoutManager;
    }

    public function showMissionList() 
    {
        try {
            $req = 'SELECT m.id, m.title, m.description, m.codeName, m.beginsAt, m.endsAt, mt.id AS idMissionType,
                    mt.name AS missionType, ms.id AS idMissionStatus, ms.name AS missionStatus, c.id AS idCountry, 
                    c.name AS country, s.id AS idSpeciality, s.name AS speciality
                    FROM mission m
                    INNER JOIN missiontype mt
                    ON m.idMissionType = mt.id
                    INNER JOIN missionstatus ms
                    ON m.idMissionStatus = ms.id
                    INNER JOIN country c
                    ON m.idCountry = c.id
                    INNER JOIN speciality s
                    ON m.idSpeciality = s.id
                    ORDER BY m.beginsAt ASC
                    ';
            $stmt = $this->getDatabase()->prepare($req);
            if ($stmt->execute()) {
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
              }
            // closing connection to database
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    

    public function showAllMissionTypes() 
    {
        try {
            $req = 'SELECT *
                    FROM missionType';
            $stmt = $this->getDatabase()->prepare($req);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
          $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showAllMissionStatuses() 
    {
        try {
            $req = 'SELECT *
                    FROM missionStatus';
            $stmt = $this->getDatabase()->prepare($req);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
          $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionAgents($id) 
    {
        try {

            $req = 'SELECT a.id, a.firstName, a.lastName
            FROM agent a
            INNER JOIN missionagent ma 
            ON ma.idAgent = a.id 
            WHERE ma.idMission = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionContacts($id) 
    {
        try {
            $req = 'SELECT c.id, c.firstName, c.lastName, c.codeName, c.idNationality
            FROM contact c
            INNER JOIN missioncontact mc
            ON mc.idContact = c.id 
            WHERE mc.idMission = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionSpeciality($id) 
    {
        try {
            $req = 'SELECT name
            FROM speciality s
            INNER JOIN mission m
            ON m.idSpeciality = s.id
            WHERE m.id= :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionStatus($id) 
    {
        try {
            $req = 'SELECT name 
                    FROM missionstatus ms
                    INNER JOIN mission m
                    ON ms.id = m.idMissionStatus
                    WHERE m.idMissionStatus = :id';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionCountry($id) 
    {
        try {
            $req = 'SELECT name 
                    FROM country c
                    INNER JOIN mission m
                    ON c.id = m.idCountry
                    WHERE m.idCountry = :id';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionTargets($id) 
    {
        try {
            $req = 'SELECT t.id, t.firstName, t.lastName, t.codeName, n.name AS nationality
            FROM target t
            INNER JOIN missiontarget mt
            ON mt.idTarget = t.id 
            INNER JOIN nationality n
            ON t.idNationality = n.id
            WHERE mt.idMission = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            // closing connection to database
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showMissionHideouts($id) 
    {
        try {
            $req = 'SELECT h.code, h.address, h.type, h.idCountry, c.name AS country
            FROM hideout h
            INNER JOIN missionhideout mh
            ON mh.idHideout = h.id 
            INNER JOIN country c
            ON h.idCountry = c.id
            WHERE mh.idMission = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    
    public function getMissionById($id) 
    {
        try {
            $req = 'SELECT m.id, m.title, m.description, m.codeName, m.beginsAt, m.endsAt, mt.name AS missionType,
                    ms.name AS missionStatus, c.name AS missionCountry, s.name AS missionSpeciality
                    FROM mission m
                    INNER JOIN missiontype mt
                    ON m.idMissionType = mt.id
                    INNER JOIN missionstatus ms
                    ON m.idMissionStatus = ms.id
                    INNER JOIN country c
                    ON m.idCountry = c.id
                    INNER JOIN speciality s
                    ON m.idSpeciality = s.id
                    WHERE m.id = :id';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }



    public function addMissionToDatabase() 
    {
        if (
            isset($_POST['title']) && !empty($_POST['title']) &&
            isset($_POST['description']) && !empty($_POST['description']) &&
            isset($_POST['codeName']) && !empty($_POST['codeName']) &&
            isset($_POST['beginsAt']) && !empty($_POST['beginsAt']) &&
            isset($_POST['endsAt']) && !empty($_POST['endsAt']) &&
            isset($_POST['idMissionType']) && !empty($_POST['idMissionType']) &&
            isset($_POST['idMissionStatus']) && !empty($_POST['idMissionStatus']) &&
            isset($_POST['idCountry']) && !empty($_POST['idCountry']) &&
            isset($_POST['idSpeciality']) && !empty($_POST['idSpeciality']) &&
            isset($_POST['idAgent']) && !empty($_POST['idAgent']) &&
            isset($_POST['idContact']) && !empty($_POST['idContact']) &&
            isset($_POST['idTarget']) && !empty($_POST['idTarget'])
        ) {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $codeName = htmlspecialchars($_POST['codeName']);
            $beginsAt = htmlspecialchars($_POST['beginsAt']);
            $endsAt = htmlspecialchars($_POST['endsAt']);
            $idMissionType = htmlspecialchars($_POST['idMissionType']);
            $idMissionStatus = htmlspecialchars($_POST['idMissionStatus']);
            $idCountry = htmlspecialchars($_POST['idCountry']);
            $idSpeciality = htmlspecialchars($_POST['idSpeciality']);
            $idAgent = array_map("htmlspecialchars", $_POST['idAgent']);
            $idContact = array_map("htmlspecialchars", $_POST['idContact']);
            $idTarget = array_map("htmlspecialchars", $_POST['idTarget']);

            //👇️ checking if agent nationality is different from target's
            foreach ($idAgent as $agent) {
                $nationalityAgent = $this->agentManager->showAgentNationality($agent);
                foreach ($idTarget as $target) {
                    $nationalityTarget = $this->targetManager->showTargetNationality($target);
                    if ($nationalityAgent == $nationalityTarget) {

                        $_SESSION['error'] = [
                            "type" => "error",
                            "msg" => "Erreur : Un agent est de même nationalité qu'une cible. Veuillez recommencer."
                        ];
                        return;
                    }
                }
            }

            $country = $this->countryManager->getCountryById($idCountry);
            //👇️ checking if contacts are from mission country
            foreach ($idContact as $contact) {
                $nationalityContact = $this->contactManager->showContactNationality($contact);
                if ($nationalityContact != $country) {

                    $_SESSION['error'] = [
                        "type" => "error",
                        "msg" => "Erreur : Un des contacts ne vient pas du pays de la mission. Veuillez recommencer."
                    ];
                    return;
                }
            }

            //👇️ checking if hideouts are located in mission country
            if (isset($_POST['idHideout']) && !empty($_POST['idHideout'])) {
                $idHideout = array_map("htmlspecialchars", $_POST['idHideout']);

                foreach ($idHideout as $hideout) {
                    $hideoutCountry = $this->hideoutManager->showHideoutCountry($hideout);
                    if ($hideoutCountry != $country) {

                        $_SESSION['error'] = [
                            "type" => "error",
                            "msg" => "Erreur : Une des planques ne se trouve pas dans le pays de la mission. Veuillez recommencer."
                        ];
                        return;
                    }
                }
            }

            //👇️ checking if at least one agent has speciality required
            $agentSpecialities = [];
            foreach ($idAgent as $agent) {
                $specialities = $this->agentManager->showAgentSpecialityId($agent);
                foreach ($specialities as $speciality) {
                    $agentSpecialities[] = $speciality;
                }
            }
            if (!in_array($idSpeciality, $agentSpecialities)) {
                $_SESSION['error'] = [
                    "type" => "error",
                    "msg" => "Erreur : Aucun agent n'a la spécialité requise. Veuillez recommencer."
                ];
                return;
            }

            $req = 'INSERT INTO mission (title, description, codeName, beginsAt, endsAt, idMissionType,
                        idMissionStatus, idCountry, idSpeciality) 
                        VALUES (:title, :description, :codeName, :beginsAt, :endsAt, :idMissionType,
                        :idMissionStatus, :idCountry, :idSpeciality)';

            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':codeName', $codeName, PDO::PARAM_STR);
            $stmt->bindValue(':beginsAt', $beginsAt, PDO::PARAM_STR);
            $stmt->bindValue(':endsAt', $endsAt, PDO::PARAM_STR);
            $stmt->bindValue(':idMissionType', $idMissionType, PDO::PARAM_INT);
            $stmt->bindValue(':idMissionStatus', $idMissionStatus, PDO::PARAM_INT);
            $stmt->bindValue(':idCountry', $idCountry, PDO::PARAM_INT);
            $stmt->bindValue(':idSpeciality', $idSpeciality, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $lastMissionId = $this->getDatabase()->lastInsertId();
                for ($i = 0; $i < sizeof($idAgent); $i++) {
                    $req = 'INSERT INTO missionagent (idMission, idAgent)
                            VALUES (:idMission, :idAgent)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $lastMissionId, PDO::PARAM_INT);
                    $stmt->bindValue(':idAgent', $idAgent[$i], PDO::PARAM_INT);
                    $stmt->execute();
                }

                for ($i = 0; $i < sizeof($idContact); $i++) {
                    $req = 'INSERT INTO missioncontact (idMission, idContact)
                    VALUES (:idMission, :idContact)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $lastMissionId, PDO::PARAM_INT);
                    $stmt->bindValue(':idContact', $idContact[$i], PDO::PARAM_INT);
                    $stmt->execute();
                }

                if (isset($_POST['idHideout']) && !empty($_POST['idHideout'])) {
                    for ($i = 0; $i < sizeof($idHideout); $i++) {
                        $req = 'INSERT INTO missionhideout (idMission, idHideout)
                        VALUES (:idMission, :idHideout)';
                        $stmt = $this->getDatabase()->prepare($req);
                        $stmt->bindValue(':idMission', $lastMissionId, PDO::PARAM_INT);
                        $stmt->bindValue(':idHideout', $idHideout[$i], PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }

                for ($i = 0; $i < sizeof($idTarget); $i++) {
                    $req = 'INSERT INTO missiontarget (idMission, idTarget)
                    VALUES (:idMission, :idTarget)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $lastMissionId, PDO::PARAM_INT);
                    $stmt->bindValue(':idTarget', $idTarget[$i], PDO::PARAM_INT);
                    $stmt->execute();
                }

                $stmt->closeCursor();

                $_SESSION['alert'] = [
                    "type" => "success",
                    "msg" => "Ajout bien pris en compte"
                ];
            }
        }
    }

    public function editMission($id) 
    {
        try {
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['title']) && !empty($_POST['title']) &&
                isset($_POST['description']) && !empty($_POST['description']) &&
                isset($_POST['codeName']) && !empty($_POST['codeName']) &&
                isset($_POST['idAgent']) && !empty($_POST['idAgent']) &&
                isset($_POST['idContact']) && !empty($_POST['idContact']) &&
                isset($_POST['idTarget']) && !empty($_POST['idTarget'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $title = htmlspecialchars($_POST['title']);
                $description = htmlspecialchars($_POST['description']);
                $codeName = htmlspecialchars($_POST['codeName']);
                $beginsAt = htmlspecialchars($_POST['beginsAt']);
                $endsAt = htmlspecialchars($_POST['endsAt']);
                $idMissionType = htmlspecialchars($_POST['idMissionType']);
                $idMissionStatus = htmlspecialchars($_POST['idMissionStatus']);
                $idCountry = htmlspecialchars($_POST['idCountry']);
                $idSpeciality = htmlspecialchars($_POST['idSpeciality']);
                $idAgent = array_map("htmlspecialchars", $_POST['idAgent']);
                $idContact = array_map("htmlspecialchars", $_POST['idContact']);
                $idTarget = array_map("htmlspecialchars", $_POST['idTarget']);

                //👇️ checking if agent nationality is different from target's
                foreach ($idAgent as $agent) {
                    $nationalityAgent = $this->agentManager->showAgentNationality($agent);
                    foreach ($idTarget as $target) {
                        $nationalityTarget = $this->targetManager->showTargetNationality($target);
                        if ($nationalityAgent == $nationalityTarget) {
                            
                            $_SESSION['error'] = [
                                "type" => "error",
                                "msg" => "Impossible de modifier la mission. Veuillez vérifier que les critères sont
                                respectés et réessayez."
                            ];
                            return;
                        }
                    }
                }

                $country = $this->countryManager->getCountryById($idCountry);
                    //👇️ checking if contacts are from mission country
                    foreach ($idContact as $contact) {
                        $nationalityContact = $this->contactManager->showContactNationality($contact);
                            if ($nationalityContact != $country) {

                                $_SESSION['error'] = [
                                    "type" => "error",
                                    "msg" => "Impossible de modifier la mission. Veuillez vérifier que les critères sont
                                    respectés et réessayez."
                                ];
                                return;
                            }
                        }

                //👇️ checking if hideouts are located in mission country
                if (isset($_POST['idHideout']) && !empty($_POST['idHideout'])) {
                    $idHideout = array_map("htmlspecialchars", $_POST['idHideout']);
                
                    foreach ($idHideout as $hideout) {
                        $hideoutCountry = $this->hideoutManager->showHideoutCountry($hideout);
                        if ($hideoutCountry != $country) {

                            $_SESSION['error'] = [
                                "type" => "error",
                                "msg" => "Impossible de modifier la mission. Veuillez vérifier que les critères sont
                                respectés et réessayez."
                            ];
                            return;
                        }
                    }
                }

                    //👇️ checking if at least one agent has speciality required
                $agentSpecialities = [];
                foreach ($idAgent as $agent) {
                    $specialities = $this->agentManager->showAgentSpecialityId($agent);
                    foreach ($specialities as $speciality) {
                        $agentSpecialities[] = $speciality;
                    }
                }

                if (!in_array($idSpeciality, $agentSpecialities)) {
                    $_SESSION['error'] = [
                        "type" => "error",
                        "msg" => "Impossible de modifier la mission. Veuillez vérifier que les critères sont
                                  respectés et réessayez."
                    ];
                    return;
                }

                $req = "
                update mission
                set title = :title,
                description = :description,
                codeName = :codeName,
                beginsAt = :beginsAt,
                endsAt = :endsAt,
                idMissionType = :idMissionType,
                idMissionStatus = :idMissionStatus,
                idCountry = :idCountry,
                idSpeciality = :idSpeciality
                WHERE id = :id
                ";

                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':title', $title, PDO::PARAM_STR);
                $stmt->bindValue(':description', $description, PDO::PARAM_STR);
                $stmt->bindValue(':codeName', $codeName, PDO::PARAM_STR);
                $stmt->bindValue(':beginsAt', $beginsAt, PDO::PARAM_STR);
                $stmt->bindValue(':endsAt', $endsAt, PDO::PARAM_STR);
                $stmt->bindValue(':idMissionType', $idMissionType, PDO::PARAM_INT);
                $stmt->bindValue(':idMissionStatus', $idMissionStatus, PDO::PARAM_INT);
                $stmt->bindValue(':idCountry', $idCountry, PDO::PARAM_INT);
                $stmt->bindValue(':idSpeciality', $idSpeciality, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();

                $req = '
                delete from missionagent where idMission  = :id
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();

                for ($i = 0; $i < sizeof($idAgent); $i++) {
                    $req = 'INSERT INTO missionagent (idMission, idAgent)
                            VALUES (:idMission, :idAgent)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $id, PDO::PARAM_INT);
                    $stmt->bindValue(':idAgent', $idAgent[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->closeCursor();
                } 
                
                $req = '
                delete from missioncontact where idMission = :id
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
                for ($i = 0; $i < sizeof($idContact); $i++) {
                    $req = 'INSERT INTO missioncontact (idMission, idContact)
                            VALUES (:idMission, :idContact)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $id, PDO::PARAM_INT);
                    $stmt->bindValue(':idContact', $idContact[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->closeCursor();
                } 

                $req = '
                delete from missionhideout where idMission = :id
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();

                if (isset($_POST['idHideout']) && !empty($_POST['idHideout'])) {
                    $idHideout = array_map("htmlspecialchars", $_POST['idHideout']);
                    for ($i = 0; $i < sizeof($idHideout); $i++) {
                    $req = 'INSERT INTO missionhideout (idMission, idHideout)
                            VALUES (:idMission, :idHideout)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $id, PDO::PARAM_INT);
                    $stmt->bindValue(':idHideout', $idHideout[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->closeCursor();
                    } 
                }

                $req = '
                delete from missiontarget where idMission = :id
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();

                for ($i = 0; $i < sizeof($idTarget); $i++) {
                    $req = 'INSERT INTO missiontarget (idMission, idTarget)
                            VALUES (:idMission, :idTarget)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idMission', $id, PDO::PARAM_INT);
                    $stmt->bindValue(':idTarget', $idTarget[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->closeCursor();
                }
            }

            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "Modification bien prise en compte"
            ];

        } catch (PDOException $e) {
            $e->getMessage();
        }

    }

    public function deleteMission($id) 
    {
        try {
            $id = htmlspecialchars($_POST['idMission']);
            $req = '
            delete from mission where id = :id
            ';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        } catch (PDOException $e) {
          $e->getMessage();
        }
    }
}