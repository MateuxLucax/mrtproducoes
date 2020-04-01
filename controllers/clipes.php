<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

    $pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

    $numberOfItemsPerPage = 4;
    $offset = ($pageNumber - 1) * $numberOfItemsPerPage;

    require_once 'classes/Conexao.class.php';

    $connection = Conexao::conexao();

    $sql = 'SELECT * FROM `Clipes` ORDER BY `codigo` DESC LIMIT '. $offset. ', '. $numberOfItemsPerPage;

    $query = $connection->query($sql, PDO::FETCH_ASSOC);
    $clipes = $query->fetchAll();

    header('Content-Type: application/json');
    $JSON = json_encode($clipes);
    
    echo $JSON;

    $connection = null;
    $query = null;

?>