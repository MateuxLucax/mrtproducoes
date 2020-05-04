<!DOCTYPE html>
  <html lang="pt-br">

  <?php 
    require_once '../controllers/classes/Connection.class.php';
    require_once 'executarEntrar.php';

    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    if ($usuario != '' || $senha != '') {
        logar($usuario, $senha);
    }
  ?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0"/>
    <title>MRT Produções &mdash; Entrar &mdash; Administrador</title>

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

    <header></header>
    
    <main>
        <div class="row">
            <div class="col s12 m6 offset-m3 l4 offset-l4">
                <div class="row">
                    <div class="col s12">
                        <h1 class="center grandma purple-title">Entrar</h1>
                    </div>
                    <form action="" method="POST">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" name="usuario" type="text" class="validate">
                            <label for="usuario">Usuário</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="senha" name="senha" type="password" class="validate">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="col s12 center">
                            <button type="submit" class="waves-effect waves-light btn">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer></footer>

    <!--  Scripts-->
    <script src="../assets/js/materialize.min.js"></script>
  </body>

  </html>