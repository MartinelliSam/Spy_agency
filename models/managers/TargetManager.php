<?php

require_once 'models/Model.php';
require_once 'models/classes/Target.php';

class TargetManager extends Model
{
    public function showTargetList()
    {
        try {
            $req = 'SELECT t.id, t.lastName, t.firstName, t.birthdate, t.codeName, n.name AS nationality
                    FROM target t
                    INNER JOIN nationality n
                    ON n.id = t.idNationality
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

    public function showTargetNationality($id)
    {
        try {
            $req = 'SELECT name 
                    FROM nationality n
                    INNER JOIN target t
                    ON t.idNationality = n.id
                    WHERE t.id = :id';
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

    public function getTargetById($id)
    {
        try {
            $req = 'SELECT id, lastName, firstName, birthdate, codeName, idNationality
                    FROM target 
                    WHERE id = :id';
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

    public function addTargetToDatabase()
    {
        if (
            isset($_POST['firstName']) && !empty($_POST['firstName']) &&
            isset($_POST['lastName']) && !empty($_POST['lastName']) &&
            isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
            isset($_POST['codeName']) && !empty($_POST['codeName']) &&
            isset($_POST['idNationality']) && !empty($_POST['idNationality'])
        ) {
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $codeName = htmlspecialchars($_POST['codeName']);
            $idNationality = htmlspecialchars($_POST['idNationality']);
            $req = 'INSERT INTO target (firstName, lastName, birthdate, codeName, idNationality) 
                    VALUES (:firstName, :lastName, :birthdate, :codeName, :idNationality)';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
            $stmt->bindValue(':codeName', $codeName, PDO::PARAM_STR);
            $stmt->bindValue(':idNationality', $idNationality, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }



    public function editTarget($id, $lastName, $firstName, $birthdate, $codeName, $idNationality)
    {
        if (
            isset($_POST['firstName']) && !empty($_POST['firstName']) &&
            isset($_POST['lastName']) && !empty($_POST['lastName']) &&
            isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
            isset($_POST['codeName']) && !empty($_POST['codeName']) &&
            isset($_POST['idNationality']) && !empty($_POST['idNationality'])
        ) {
            $id = htmlspecialchars($_POST['id']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $firstName = htmlspecialchars($_POST['firstName']);
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $codeName = htmlspecialchars($_POST['codeName']);
            $idNationality = htmlspecialchars($_POST['idNationality']);
            try {
                $req = "
                        update target
                        set lastName = :lastName,
                        firstName = :firstName,
                        birthdate = :birthdate,
                        codeName = :codeName,
                        idNationality = :idNationality
                        WHERE id = :id
                        ";
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
                $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':codeName', $codeName, PDO::PARAM_STR);
                $stmt->bindValue(':idNationality', $idNationality, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public function deleteTarget($id)
    {
        try {
            $id = htmlspecialchars($_POST['idTarget']);
            $req = '
                delete from target where id = :id
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