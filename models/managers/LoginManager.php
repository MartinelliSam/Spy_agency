<?php

require_once 'models/Model.php';

class LoginManager extends Model
{

  public function connect()
  {
      if (!isset($_POST['token']) || ($_POST['token'] !== $_SESSION['token'])) {
          header('Location: ' . BASE_URL . '/login');
          return;
      }

      if (isset($_POST['email']) && !empty($_POST['email']) &&
          isset($_POST['password']) && !empty($_POST['password'])) {
          $email    = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = [
                "type" => "error",
                "msg" => "Authentification impossible."
            ];
            header('Location: ' . BASE_URL . '/login');
            return;
          }
      }

      try {
          $req = 'SELECT *
                  FROM user
                  WHERE email = :email
                  ';
          $stmt = $this->getDatabase()->prepare($req);
          $stmt->bindValue(':email', $email, PDO::PARAM_STR);
          if ($stmt->execute()) {
              $user = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($user === false) {
                  $_SESSION['error'] = [
                    "type" => "error",
                    "msg" => "Authentification impossible."
                  ];
                  header('Location: ' . BASE_URL . '/login');
                  return;
              } else {
                  // checking if hashed password in db is the same as typed
                  if (password_verify($password, $user['password'])) {
                      $_SESSION['connect'] = 1;
                      $_SESSION['role'] = $user['role'];

                      $_SESSION['alert'] = [
                        "type" => "success",
                        "msg" => "Bienvenue, " . $user['firstName'] . " " . $user['lastName']
                      ];

                      header('Location: ' . BASE_URL . '/');
                  } else {
                        $_SESSION['error'] = [
                          "type" => "error",
                          "msg" => "Authentification impossible."
                        ];

                        header('Location: ' . BASE_URL . '/login');
                  }
              }
          }
            // closing connection to database
            $stmt->closeCursor();
        } catch (PDOException $e) {
              $e->getMessage();
        }
    }
}
