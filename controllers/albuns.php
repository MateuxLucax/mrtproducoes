<?php

    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

    $albumProdutos = 25; // Altera aqui o código do álbum dos produtos

    $numberOfItemsPerPage = 8;
    $offset = ($pageNumber - 1) * $numberOfItemsPerPage;

    require_once 'classes/Conexao.class.php';

    $connection = Conexao::conexao();

    $sql = 'SELECT * FROM `Album` WHERE `codigo` != '. $albumProdutos. ' ORDER BY `codigo` DESC  LIMIT '. $offset. ', '. $numberOfItemsPerPage;

    $query = $connection->query($sql, PDO::FETCH_ASSOC);
    $albuns = $query->fetchAll();

    header('Content-Type: application/json');
    $JSON = json_encode($albuns);
    
    echo $JSON;

    $connection = null;
    $query = null;

?>