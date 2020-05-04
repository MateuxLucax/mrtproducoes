<?php 

    function getClientIp() {
        return file_get_contents("https://ipecho.net/plain");
    }

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d/m/Y h:i:s a', time());
    $log = "\n Someone on (". $date. ") with this ip: (". getClientIp(). ") tried to access acao.php";

    file_put_contents('unauthorizedAccess.txt', $log, FILE_APPEND);

?>