<?php

    require_once "classes/Connection.class.php";

    $albumProdutos = 25; // Altera aqui o código do álbum dos produtos

    $getTitle = isset($_GET["getTitle"]) ? ($_GET["getTitle"]  == "true" ? true : false) : false;
    $album = isset($_GET["id"]) ? $_GET["id"] : 1;
    $orderByDesc = isset($_GET["orderByDesc"]) ? ($_GET["orderByDesc"] == "true" ? true : false) : false;
    $pageNumber = isset($_GET["page"]) ? $_GET["page"] : 1;

    if (is_numeric($album)) {
        settype($album, "integer");

        try {
            $dbh = Connection::connection();
        } catch (PDOException $e){
            error_log("Error establishing connection with database");
            http_response_code(500);
            die("Error establishing connection with database");
            exit();
        }

        if ($getTitle == true) {
            $query = "SELECT `titulo` 
                      FROM `Album` 
                      WHERE `codigo` = :album";
            $sth = $dbh->prepare($query);
            
            $sth->bindParam(":album", $album, PDO::PARAM_INT);    
        } else if (is_numeric($pageNumber)) {
            settype($pageNumber, "integer");
            $numberOfItemsPerPage = 25;
            $offset = ($pageNumber - 1) * $numberOfItemsPerPage;

            if ($orderByDesc == true) {                
                $query = "SELECT * 
                          FROM `Fotos` 
                          WHERE `album` = :album
                          ORDER BY `codigo_foto` DESC
                          LIMIT :offset, :numberOfItemsPerPage";
            } else {
                $query = "SELECT * 
                          FROM `Fotos` 
                          WHERE `album` = :album
                          LIMIT :offset, :numberOfItemsPerPage";
            }

            $sth = $dbh->prepare($query);
            
            $sth->bindParam(":album", $album, PDO::PARAM_INT);
            $sth->bindParam(":offset", $offset, PDO::PARAM_INT);
            $sth->bindParam(":numberOfItemsPerPage", $numberOfItemsPerPage, PDO::PARAM_INT);
        } else {
            http_response_code(400);
            die("Error processing bad or malformed request");
            exit();
        }

        try {
            $sth->execute();
                    
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sth->fetchAll();
            
            http_response_code(200);
            header("Content-Type: application/json");
            print(json_encode($result));
            
            $dbh = null;
        } catch (PDOException $e) {
            error_log("Error on request");
            http_response_code(500);
            die("Error on request");
        }
    } else {
        http_response_code(400);
        die("Error processing bad or malformed request");
    }

?>