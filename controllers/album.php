<?php

    require_once 'classes/Conexao.class.php';

    $connection = Conexao::conexao();

    $getTitle = isset($_GET['getTitle']) ? $_GET['getTitle'] : false;
    $album = isset($_GET['id']) ? $_GET['id'] : 1;
    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

    if ($getTitle == true) {
        $sql = 'SELECT `titulo` FROM `Album` WHERE codigo = '. $album;
    } else {
        $numberOfItemsPerPage = 25;
        $offset = ($pageNumber - 1) * $numberOfItemsPerPage;
    
        $sql = 'SELECT * FROM `Fotos` WHERE `album` = '. $album. ' LIMIT '. $offset. ', '. $numberOfItemsPerPage;
    }

    $query = $connection->query($sql, PDO::FETCH_ASSOC);
    $response = $query->fetchAll();

    header('Content-Type: application/json');
    $JSON = json_encode($response);
    echo $JSON;
    
    $connection = null;
    $query = null;

?>