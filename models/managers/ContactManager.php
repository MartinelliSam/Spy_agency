<?php

require_once 'models/Model.php';
require_once 'models/classes/Contact.php';

class ContactManager extends Model 
{
    public function showContactList() 
    {
        try {
            $req = 'SELECT c.id, c.lastName, c.firstName, c.birthdate, c.codeName, n.name AS nationality
            FROM contact c
            INNER JOIN nationality n
            ON n.id = c.idNationality
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

    public function showContactNationality($id) 
    {
        try {
            $req = 'SELECT name 
                    FROM nationality n
                    INNER JOIN contact c
                    ON c.idNationality = n.id
                    WHERE c.id = :id';
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

  public function getContactById($id) 
  {
        try {
            $req = 'SELECT c.id, c.lastName, c.firstName, c.birthdate, c.codeName, n.name AS nationality
                    FROM contact c
                    INNER JOIN nationality n
                    ON n.id = c.idNationality
                    WHERE c.id = :id';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function addContactToDatabase() 
    {
        if (isset($_POST['firstName']) && !empty($_POST['firstName']) &&
            isset($_POST['lastName']) && !empty($_POST['lastName']) &&
            isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
            isset($_POST['codeName']) && !empty($_POST['codeName']) &&
            isset($_POST['idNationality']) && !empty($_POST['idNationality'])) {
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $birthdate = htmlspecialchars($_POST['birthdate']);
            $codeName = htmlspecialchars($_POST['codeName']);
            $idNationality = htmlspecialchars($_POST['idNationality']);
            try {
                $req = 'INSERT INTO contact (lastName, firstName, birthdate, codeName, idNationality) 
                        VALUES (:lastName, :firstName, :birthdate, :codeName, :idNationality)';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
                $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
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

    public function editContact($id, $lastName, $firstName, $birthdate, $codeName, $idNationality)
    {
        if (isset($_POST['firstName']) && !empty($_POST['firstName']) &&
            isset($_POST['lastName']) && !empty($_POST['lastName']) &&
            isset($_POST['birthdate']) && !empty($_POST['birthdate']) &&
            isset($_POST['codeName']) && !empty($_POST['codeName']) &&
            isset($_POST['idNationality']) && !empty($_POST['idNationality'])) {
            try {
                $id = htmlspecialchars($_POST['id']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $firstName = htmlspecialchars($_POST['firstName']);
                $birthdate = htmlspecialchars($_POST['birthdate']);
                $codeName = htmlspecialchars($_POST['codeName']);
                $idNationality = htmlspecialchars($_POST['idNationality']);
                $req = "
                        update contact
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

    public function deleteContact($id) 
    {
        try {
            $id = htmlspecialchars($_POST['idContact']);
            $req = '
            delete from contact where id = :id
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