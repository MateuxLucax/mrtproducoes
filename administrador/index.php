<!DOCTYPE html>
  <html lang="pt-br">

  <?php 
    require_once 'valida.php';
  ?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0"/>
    <title> Administrador &mdash; Página Inicial</title>

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
            <li><a class="nunito" href="sair.php"><i class="material-icons">input</i></a></li>
          </ul>
        </div>
      </nav>
    </header>
    
    <main>
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col s12">
              <h3 class="center grandma purple-title">Oiê, <?php echo $_SESSION['usuario']; ?></h3>
            </div>
            <div class="col s12 center">
              <a href="album.php" class="waves-effect waves-light btn-large"><i class="material-icons right">collections</i>Álbuns</a>
              <br/>
              <br/>
              <a href="clipes.php" class="waves-effect waves-light btn-large"><i class="material-icons right">movie</i>Clipes</a>
              <br/>
              <br/>              
              <a href="parceiros.php" class="waves-effect waves-light btn-large"><i class="material-icons right">contacts</i>Parceiros</a>
              <br/>
              <br/>              
              <a href="adicionarUsuario.php" class="waves-effect waves-light btn-large"><i class="material-icons right">person_add</i>Adicionar Administrador</a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer></footer>

    <!-- Scripts -->
    <script src="../assets/js/materialize.min.js"></script>
  </body>

  </html>