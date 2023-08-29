<?php

require_once 'models/Model.php';
require_once 'models/classes/Agent.php';

class AgentManager extends Model
{
    public function showAgentList() 
    {
        try {
            $req = 'SELECT a.id, a.lastName, a.firstName, a.birthdate, a.identificationCode, n.name AS nationality
                    FROM agent a
                    INNER JOIN nationality n
                    ON n.id = a.idNationality
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

    public function showAgentNationality($id) 
    {
        try {
            $req = 'SELECT name 
                    FROM nationality n
                    INNER JOIN agent a
                    ON a.idNationality = n.id
                    WHERE a.id = :id';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['name'];
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    
    public function showAgentSpeciality($id) 
    {
        try {
            $req = 'SELECT name
            FROM speciality s
            INNER JOIN agentspeciality sp 
            ON sp.idSpeciality = s.id 
            WHERE sp.idAgent = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function showAgentSpecialityId($id) 
    {
        try {
            $req = 'SELECT id
            FROM speciality s
            INNER JOIN agentspeciality sp 
            ON sp.idSpeciality = s.id 
            WHERE sp.idAgent = :id;'
            ;
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $result;
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getAgentById($id) 
    {
        try {
            $req = 'SELECT a.id, a.lastName, a.firstName, a.birthdate, a.identificationCode, n.name AS nationality
                    FROM agent a 
                    INNER JOIN nationality n
                    ON a.idNationality = n.id
                    WHERE a.id = :id';
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

    public function addAgentToDatabase() 
    {
        if (isset($_POST['firstName']) && !empty($_POST['firstName']) &&
            isset($_POST['lastName']) && !empty($_POST['lastName']) &&
            isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
            isset($_POST['identificationCode']) && !empty($_POST['identificationCode']) &&
            isset($_POST['idNationality']) && !empty($_POST['idNationality']) &&
            isset($_POST['idSpeciality']) && !empty($_POST['idSpeciality'])) {
                $firstName = htmlspecialchars($_POST['firstName']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $birthdate = htmlspecialchars($_POST['birthdate']);
                $identificationCode = htmlspecialchars($_POST['identificationCode']);
                $idNationality = htmlspecialchars($_POST['idNationality']);
                $idSpeciality = array_map("htmlspecialchars", $_POST['idSpeciality']);
                $req = 'INSERT INTO agent (firstName, lastName, birthdate, identificationCode, idNationality) 
                        VALUES (:firstName, :lastName, :birthdate, :identificationCode, :idNationality)';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':identificationCode', $identificationCode, PDO::PARAM_STR);
                $stmt->bindValue(':idNationality', $idNationality, PDO::PARAM_INT);
                if($stmt->execute()) {
                    $lastAgentId = $this->getDatabase()->lastInsertId();
                    for ($i = 0; $i < sizeof($idSpeciality); $i++) {
                    $req = 'INSERT INTO agentspeciality (idAgent, idSpeciality)
                    VALUES (:idAgent, :idSpeciality)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idAgent', $lastAgentId, PDO::PARAM_INT);
                    $stmt->bindValue(':idSpeciality', $idSpeciality[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    }
                }    
                $stmt->closeCursor();
        }
    }

    public function editAgent($id) 
    {
        try {
            if (isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['lastName']) && !empty($_POST['lastName']) &&
                isset($_POST['firstName']) && !empty($_POST['firstName']) &&
                isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
                isset($_POST['identificationCode']) && !empty($_POST['identificationCode']) &&
                isset($_POST['idNationality']) && !empty($_POST['idNationality'])) {
                $id = htmlspecialchars($_POST['id']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $firstName = htmlspecialchars($_POST['firstName']);
                $birthdate = htmlspecialchars($_POST['birthdate']);
                $identificationCode = htmlspecialchars($_POST['identificationCode']);
                $idNationality = htmlspecialchars($_POST['idNationality']);
                $req = "
                update agent
                set lastName = :lastName,
                firstName = :firstName,
                birthdate = :birthdate,
                identificationCode = :identificationCode,
                idNationality = :idNationality
                WHERE id = :id
                ";
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':identificationCode', $identificationCode, PDO::PARAM_INT);
                $stmt->bindValue(':idNationality', $idNationality, PDO::PARAM_INT);
                $stmt->execute();
                
                $req = '
                delete from agentspeciality where idAgent = :id
                ';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();

                if(isset($_POST['idSpeciality']) && !empty($_POST['idSpeciality'])) {
                    $idSpeciality = array_map("htmlspecialchars", $_POST['idSpeciality']);
                    for ($i = 0; $i < sizeof($idSpeciality); $i++) {
                    $req = 'INSERT INTO agentspeciality (idAgent, idSpeciality)
                            VALUES (:idAgent, :idSpeciality)';
                    $stmt = $this->getDatabase()->prepare($req);
                    $stmt->bindValue(':idAgent', $id, PDO::PARAM_INT);
                    $stmt->bindValue(':idSpeciality', $idSpeciality[$i], PDO::PARAM_INT);
                    $stmt->execute();
                    $stmt->closeCursor();
                    } 
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function deleteAgent($id) 
    {
        try {
            $id = htmlspecialchars($_POST['idAgent']);
            $req = '
            delete from agent where id = :id
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