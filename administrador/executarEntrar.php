<?php

  function logar($user, $password) {

    try {
      $dbh = Connection::connection();
    } catch (PDOException $e){
        error_log("Error establishing connection with database");
        http_response_code(500);
        die("Error establishing connection with database");
        exit();
    }

    if (is_string($user) && is_string($password)) {

      try {
        $query = "SELECT `usuario` 
                  FROM `Administrador` 
                  WHERE `senha` = :senha";

        $sth = $dbh->prepare($query);

        $sth->bindParam(":senha", hash('sha512', $password), PDO::PARAM_STR, 128);
        $sth->execute();
        
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $result = $sth->fetchColumn();

        if ($result == $user) {
          session_start();
          unset($_SESSION['usuario']);
          unset($_SESSION['token']);
          session_destroy();
          session_start();
          $_SESSION['usuario'] = $user;
          $_SESSION['token'] = bin2hex(random_bytes(32));
          header("location:index.php");
        } else {
          header("location:entrar.php");
        }
      } catch (PDOException $e) {
        header("location:entrar.php");
      }
    }

  }

?>