<?php

require_once 'models/Model.php';
require_once 'models/classes/Hideout.php';

class HideoutManager extends Model 
{
    public function showHideoutList() 
    {
        try {
            $req = 'SELECT h.id, h.code, h.address, h.type, c.name AS country
            FROM hideout h
            INNER JOIN country c
            ON c.id = h.idCountry
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

    public function getHideoutById($id) 
    {
        try {
            $req = 'SELECT id, code, address, type, idCountry
                    FROM hideout 
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
    
    public function showHideoutCountry($id) 
    {
        try {
            $req = 'SELECT name 
                    FROM country c
                    INNER JOIN hideout h
                    ON c.id = h.idCountry
                    WHERE h.id = :id';
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

    public function addHideoutToDatabase() 
    {
        if (isset($_POST['code']) && !empty($_POST['code']) &&
            isset($_POST['address']) && !empty($_POST['address']) &&
            isset($_POST['type']) && !empty($_POST['type']) &&
            isset($_POST['idCountry']) && !empty($_POST['idCountry'])) {
            $code = htmlspecialchars($_POST['code']);
            $address = htmlspecialchars($_POST['address']);
            $type = htmlspecialchars($_POST['type']);
            $idCountry = htmlspecialchars($_POST['idCountry']);
            $req = 'INSERT INTO hideout (code, address, type, idCountry) VALUES (:code, :address, :type, :idCountry)';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':code', $code, PDO::PARAM_INT);
            $stmt->bindValue(':address', $address, PDO::PARAM_STR);
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':idCountry', $idCountry, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }


      public function editHideout($id, $code, $address, $type, $idCountry) 
      {
        if (isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['code']) && !empty($_POST['code']) &&
            isset($_POST['address']) && !empty($_POST['address']) &&
            isset($_POST['type']) && !empty($_POST['type']) &&
            isset($_POST['idCountry']) && !empty($_POST['idCountry'])) {
            try {
                $req = "
                update hideout
                set code = :code,
                address = :address,
                type = :type,
                idCountry = :idCountry
                WHERE id = :id
                ";
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':code', $code, PDO::PARAM_INT);
                $stmt->bindValue(':address', $address, PDO::PARAM_STR);
                $stmt->bindValue(':type', $type, PDO::PARAM_STR);
                $stmt->bindValue(':idCountry', $idCountry, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    
    public function deleteHideout($id) 
    {
        try {
            $req = '
            delete from hideout where id = :id
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