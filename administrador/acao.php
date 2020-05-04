<?php

  require_once "unauthorizedAccess.php";

  session_start();

  $token =  isset($_GET['token']) ? $_GET['token'] : $_POST['token'];
  if (!isset($_SESSION['usuario']) || !hash_equals($_SESSION['token'], $token)) {
    http_response_code(403);
    die("You shouldn't be accessing this file. Please login or go back to website!"); 
  }
  
  require_once '../controllers/classes/Connection.class.php';

  $acao = isset($_GET['acao']) ? $_GET['acao'] : $_POST['acao'];
  $link = isset($_GET['link']) ? $_GET['link'] : $_POST['link'];
  if (empty($link)) {
    $link = 'index.php';
  }
  $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : $_POST['tabela'];
  $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : $_GET['codigo'];
  
  if (!empty($tabela) && !empty($acao)) {
    settype($tabela, "string");
    settype($acao, "string");
    
    if ($acao == "excluir" && is_numeric($codigo)) {
      settype($codigo, "integer");
      
      // Clipes
      if ($tabela == "Clipes") {
        $sql = 'DELETE FROM '. $tabela. ' WHERE codigo = '. $codigo;
      }

      // Albuns
      elseif ($tabela == "Album") {
        $sql = 'DELETE FROM '. $tabela. ' WHERE codigo = '. $codigo;
      }

      // Fotos
      elseif ($tabela == "Fotos") {
        $sql = 'DELETE FROM '. $tabela. ' WHERE codigo_foto = '. $codigo;
      }

      // Parceiros
      elseif ($tabela == "Parceiros") {
        $sql = 'DELETE FROM '. $tabela. ' WHERE codigo = '. $codigo;
      }
    }

    elseif ($acao == "inserir" || $acao == "alterar") {
      
      // Clipes
      if ($tabela == "Clipes") {
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $linkClipe = isset($_POST['linkClipe']) ? $_POST['linkClipe'] : '';
        if ($acao == 'inserir') {
          $sql = 'INSERT INTO '. $tabela. ' VALUES (null, "'. $titulo. '", "'. $linkClipe . '")';
        } elseif ($acao == 'alterar' && is_numeric($codigo)) {
          settype($codigo, "integer");
          $sql = 'UPDATE '. $tabela. ' SET titulo = "'. $titulo. '", link = "'. $linkClipe .'" WHERE codigo = '. $codigo;
        }
      } 
      
      // Albuns
      elseif ($tabela == "Album") {
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $capa = isset($_POST['capa']) ? $_POST['capa'] : '';
        if ($acao == 'inserir') {
          $sql = 'INSERT INTO '. $tabela. ' VALUES (null, "'. $titulo. '", "'. $capa . '")';
        } elseif ($acao == 'alterar' && is_numeric($codigo)) {
          settype($codigo, "integer");
          $sql = 'UPDATE '. $tabela. ' SET titulo = "'. $titulo. '", capa = "'. $capa .'" WHERE codigo = '. $codigo;
        }
      }
      
      // Fotos
      elseif ($tabela == "Fotos") {
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
        $linkFoto = isset($_POST['linkFoto']) ? $_POST['linkFoto'] : '';
        $album = isset($_POST['album']) ? $_POST['album'] : ''; 
        settype($album, "integer");
        if ($acao == 'inserir') {
          $sql = 'INSERT INTO '. $tabela. ' VALUES (null, "'. $linkFoto . '", '. $album. ')';
        } elseif ($acao == 'alterar' && is_numeric($codigo)) {
          settype($codigo, "integer");
          $sql = 'UPDATE '. $tabela. ' SET link = "'. $linkFoto .'" WHERE codigo_foto = '. $codigo;
        }
      }
      
      // Parceiros
      elseif ($tabela == "Parceiros") {
        $foto = isset($_POST['foto']) ? $_POST['foto'] : '';
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $profissao = isset($_POST['profissao']) ? $_POST['profissao'] : '';
        $titulo_link = isset($_POST['titulo_link']) ? $_POST['titulo_link'] : '';
        $link_contato = isset($_POST['link_contato']) ? $_POST['link_contato'] : '';
        if ($acao == 'inserir') {
          $sql = 'INSERT INTO '. $tabela. ' VALUES (null, "'. $foto. '", "'. $nome . '", "'. $profissao. '", "'. $titulo_link . '", "'. $link_contato . '")';
        } elseif ($acao == 'alterar' && is_numeric($codigo)) {
          settype($codigo, "integer");
          $sql = 'UPDATE '. $tabela. ' SET foto = "'. $foto. '", nome = "'. $nome .'", profissao = "'. $profissao. '", titulo_link = "'. $titulo_link .'", link = "'. $link_contato .'" WHERE codigo = '. $codigo;
        }
      }
    }

    echo $sql;

    try {
      $dbh = Connection::connection();
      try {
        $dbh->query($sql);
      } catch (PDOException $e){
        error_log("Error on query!");
        http_response_code(500);
        die("Error on query!");
        exit();
      }  
    } catch (PDOException $e){
      error_log("Error establishing connection with database");
      http_response_code(500);
      die("Error establishing connection with database");
      exit();
    }  
  }

  header('location: '. $link);
?>  
