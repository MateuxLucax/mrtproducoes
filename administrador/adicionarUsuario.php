<!DOCTYPE html>
  <html lang="pt-br">

  <?php 
    $usuario = isset($_POST['user']) ? $_POST['user'] : false;
    $senha = isset($_POST['pass']) ? $_POST['pass'] : false;

    require_once '../controllers/classes/Connection.class.php';
    require_once 'valida.php';

  
    if (is_string($usuario) && is_string($senha)) {
      
      $token = $_POST['token'];

      if (!isset($_SESSION['usuario']) || !hash_equals($_SESSION['token'], $token)) {
        http_response_code(403);
        die("You shouldn't be accessing this file. Please login or go back to website!"); 
        exit();
      }

      try {
        $dbh = Connection::connection();
      } catch (PDOException $e){
        error_log("Error establishing connection with database");
        http_response_code(500);
        $erro = "Error establishing connection with database";
        exit();
      }  

      try {
        $query = "INSERT INTO `Administrador` 
                  VALUES (:usuario, :senha)";

        $sth = $dbh->prepare($query);

        $senha = hash('sha512', $senha);

        $sth->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $sth->bindParam(":senha", $senha, PDO::PARAM_STR, 128);
        $sth->execute();  
        
        $sucesso = "Usuário cadastrado";
        
        $dbh = null;
      } catch (PDOException $e) {
        $erro = "Erro ao cadastrar usuário!";
      }
    }

  ?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0"/>
    <title>Administrador &mdash; Adicionar Administrador</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/icons/favicon.png" />
    <link rel="apple-touch-icon" href="../assets/img/icons/favicon.png" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preload"
      href="https://use.typekit.net/af/1b925c/00000000000000000000fd86/27/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n7&v=3"
      as="font" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/dpf2exc.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap" rel="stylesheet"> 
    <link href="../assets/css/grandmaFont.css" rel="stylesheet" />
    
    <!-- CSS -->
    <link href="../assets/css/admin-style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>

  <body>

    <header>
      <nav>
        <div class="nav-wrapper container">
          <a href="./" class="brand-logo">MRT Produções</a>
          <ul class="right">
            <li><a href="sair.php"><i class="material-icons">input</i></a></li>
          </ul>
        </div>
      </nav>
    </header>
    
    <main>
        <div class="row">
            <div class="col s12 m6 offset-m3 l4 offset-l4">
                <div class="row">
                    <div class="col s12">
                      <h3 class="center grandma purple-title">Cadastrar Administrador</h3>
                      <?php 
                        if (isset($erro)) {
                          echo "<h5 class='red-text center'>". $erro."</h5>";
                        } else if (isset($sucesso)) {
                          echo "<h5 class='green-text center'>". $sucesso."</h5>";
                        }
                      ?>
                    </div>
                    <form action="" method="POST">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="user" name="user" type="text" class="validate">
                            <label for="user">Usuário</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="pass" name="pass" type="password" class="validate">
                            <label for="pass">Senha</label>
                        </div>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                        <div class="col s12 center">
                            <button type="submit" class="waves-effect waves-light btn">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer></footer>

    <!-- Scripts -->
    <script src="../assets/js/materialize.min.js"></script>
  </body>

  </html>