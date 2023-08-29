<?php

require_once 'models/Model.php';
require_once 'models/classes/Speciality.php';

class SpecialityManager extends Model
{
    public function showSpecialityList()
    {
        try {
            $req = 'SELECT * FROM speciality';
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

    public function getSpecialityById($id)
    {
        try {
            $req = 'SELECT id, name, description
                    FROM speciality
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

    public function addSpecialityToDatabase()
    {
        if (
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['description']) && !empty($_POST['description'])
        ) {
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            try {
                $req = 'INSERT INTO speciality (name, description) 
                        VALUES (:name, :description)';
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->bindValue(':description', $description, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public function editSpeciality($id, $name, $description)
    {
        if (
            isset($_POST['id']) && !empty($_POST['id']) &&
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['description']) && !empty($_POST['description'])
        ) {
            try {
                $id = htmlspecialchars($_POST['id']);
                $name = htmlspecialchars($_POST['name']);
                $description = htmlspecialchars($_POST['description']);
                $req = "
                update speciality
                set name = :name, 
                description = :description
                WHERE id = :id
                ";
                $stmt = $this->getDatabase()->prepare($req);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->bindValue(':description', $description, PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public function deleteSpeciality($id)
    {
        try {
            $id = htmlspecialchars($_POST['idSpeciality']);
            $req = '
            delete from speciality where id = :id
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