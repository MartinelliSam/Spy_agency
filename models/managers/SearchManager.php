<?php
require_once 'models/Model.php';

class SearchManager extends Model
{
    public function search()
    {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = $_POST['name'];

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
                WHERE m.title
                LIKE :name
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                // closing connection to database
                $stmt->closeCursor();
                return;
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } else if (isset($_POST['idCountry']) && !empty($_POST['idCountry'])) {
            $idCountry = $_POST['idCountry'];
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
                WHERE idCountry = :idCountry
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':idCountry', $idCountry, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return;
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } else if (isset($_POST['idAgent']) && !empty($_POST['idAgent'])) {
            $idAgent = $_POST['idAgent'];
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
                INNER JOIN missionagent ma
                ON ma.idMission = m.id
                WHERE ma.idAgent = :idAgent
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':idAgent', $idAgent, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return;
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } else if (isset($_POST['idTarget']) && !empty($_POST['idTarget'])) {
            $idTarget = $_POST['idTarget'];
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
                INNER JOIN missiontarget mta
                ON mta.idMission = m.id
                WHERE mta.idTarget = :idTarget
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':idTarget', $idTarget, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return;
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }
}