<?php

require_once 'models/Model.php';
require_once 'models/classes/Country.php';

class CountryManager extends Model 
{
    public function showCountryList() 
    {
        try {
            $req = 'SELECT * FROM country';
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

    public function getCountryById($id) 
    {
        try {
            $req = 'SELECT name
                    FROM country 
                    WHERE id = :id';
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
    
    public function addCountryToDatabase() 
    {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
            $req = 'INSERT INTO country (name) VALUES (:name)';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }




    public function editCountry($id, $name) 
    {
        if (isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['name']) && !empty($_POST['name'])) {
            try {
                $id = htmlspecialchars($_POST['id']);
                $name = htmlspecialchars($_POST['name']);
                $req = "
                update country
                set name = :name 
                WHERE id = :id
                ";
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public function deleteCountry($id) 
    {
        try {
          $id = htmlspecialchars($_POST['idCountry']);
          $req = '
          delete from country where id = :id
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