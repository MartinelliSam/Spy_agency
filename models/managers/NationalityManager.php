<?php

require_once 'models/Model.php';
require_once 'models/classes/Nationality.php';

class NationalityManager extends Model 
{
    public function showNationalityList() 
    {
        try {
            $req = 'SELECT * FROM nationality';
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

    public function addNationalityToDatabase() 
    {
        if(isset($_POST['name']) && !empty($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);
            $req = 'INSERT INTO nationality (name) VALUES (:name)';
            $stmt = $this->getDatabase()->prepare($req);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        }
    }



    public function editNationality($id, $name)
    {
        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['name']) && !empty($_POST['name'])
        ) {
            try {
                $req = '
                update nationality
                set name = :name 
                WHERE id = :id
                ';
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

    public function deleteNationality($id) {
        try {
            $req = '
            delete from nationality where id = :id
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