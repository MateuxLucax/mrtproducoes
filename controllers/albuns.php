<?php

    require_once "classes/Connection.class.php";
    $albumProdutos = 25; // Altera aqui o código do álbum dos produtos

    $pageNumber = isset($_GET["page"]) ? $_GET["page"] : 1;
    
    if (is_numeric($pageNumber)) {
        settype($pageNumber, "integer");
        if (is_int($pageNumber) == true) {
            try { 
                $numberOfItemsPerPage = 8 ;
                $offset = ($pageNumber - 1) * $numberOfItemsPerPage;
                
                try {
                    $dbh = Connection::connection();
                } catch (PDOException $e){
                    error_log("Error establishing connection with database");
                    http_response_code(500);
                    die("Error establishing connection with database");
                    exit();
                }

                $query = "SELECT * 
                          FROM `Album` 
                          WHERE `codigo` != :albumProdutos
                          ORDER BY `codigo` 
                          DESC LIMIT :offset, :numberOfItemsPerPage";
                $sth = $dbh->prepare($query);
                
                $sth->bindParam(":albumProdutos", $albumProdutos, PDO::PARAM_INT);
                $sth->bindParam(":offset", $offset, PDO::PARAM_INT);
                $sth->bindParam(":numberOfItemsPerPage", $numberOfItemsPerPage, PDO::PARAM_INT);
                $sth->execute();
                
                $sth->setFetchMode(PDO::FETCH_ASSOC);
                $result = $sth->fetchAll();
                
                http_response_code(200);
                header("Content-Type: application/json");
                print(json_encode($result));
                
                $dbh = null;
            } catch (PDOException $e){
                error_log("Error on request");
                http_response_code(500);
                die("Error on request");
            }
        }
    } else {
        http_response_code(400);
        die("Error processing bad or malformed request");
    }

?>