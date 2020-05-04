<!DOCTYPE html>
  <html lang="pt-br">

  <?php 
    require_once '../controllers/classes/Connection.class.php';
	require_once 'valida.php';

    try {
		$dbh = Connection::connection();
	} catch (PDOException $e){
		error_log("Error establishing connection with database");
		http_response_code(500);
		die("Error establishing connection with database");
		exit();
	}

	$tabela = "Album";

	$link = 'album.php';
	$sql = "SELECT * FROM `Album`";
	?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0"/>
    <title>Administrador &mdash; Álbum</title>

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
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col s12">
              <h3 class="center grandma purple-title">Álbuns</h3>
            </div>
          </div>
					<div class="row">
							<div class="col s12">
									<table class="striped responsive-table centered">
											<thead>
													<tr>
															<th>Código</th>
															<th>Título</th>
															<th>Capa</th>
															<th>Adicionar fotos</th>
															<th>Alterar</th>
															<th>Excluir</th>
													</tr>
											</thead>
											<tbody>
													<!-- Inserir -->
													<tr>
															<td colspan="4"></td>
															<td><b>Adicionar</b></td>
															<td>
															<a class="waves-effect waves-light modal-trigger mrt-text" href="#inserir"><i class="material-icons">add_circle_outline</i></a>
															<div id="inserir" class="modal">
																	<div class="modal-content">
																			<center>
																					<h4>Inserir</h4>
																					<form action="acao.php" method="post">
																							<div class="input-field col s12">
																									<input id="titulo" type="text" name="titulo" />
																									<label for="titulo">Título</label>
																							</div>
																							<div class="input-field col s12">
																									<input id="linkCapa" type="text" name="capa" />
																									<label for="linkCapa">Capa</label>
																							</div>
																							<center>
																									<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
																									<input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
																									<input type="hidden" name="link" value="<?php echo $link; ?>">
																									<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
																									<button class="waves-effect waves-green btn-flat black-text" name="acao" value="inserir"><i class="material-icons right">send</i>Inserir</button>
																							</center>
																					</form>
																			</center>
																	</div>
															</div>
															</td>
													</tr>
													<?php foreach ($dbh->query($sql) as $row) { ?>
													<tr>
															<td>
																	<?php echo $row['codigo']; ?>
															</td>
															<td>
																	<?php echo $row['titulo']; ?>
															</td>
															<td>
                                                                <img src="<?php echo $row['capa']; ?>" style="height:100px" alt="">
															</td>
															<td>
																<a class="waves-effect waves-light modal-trigger mrt-text text-azul" href="foto.php?a=<?php echo $row['codigo'] ?>"><i class="material-icons">add_circle_outline</i></a>
															</td>
															<!-- Alterar -->
															<td>
																<a class="waves-effect waves-light modal-trigger green-text" href="#alterar<?php echo $row['codigo'] ;?>"><i class="material-icons">build</i></a>
																<div id="alterar<?php echo $row['codigo'] ;?>" class="modal">
																		<div class="modal-content">
																				<center>
																						<h4>Alterar</h4>
																						<form action="acao.php" method="post">
																								<div class="input-field col s12">
																										<input id="titulo" type="text" name="titulo" value="<?php echo $row['titulo']; ?>" />
																										<label for="titulo">Título</label>
																								</div>
																								<div class="input-field col s12">
																										<input id="linkCapa" type="text" name="capa" value="<?php echo $row['capa']; ?>" />
																										<label for="linkCapa">Capa</label>
																								</div>
																								<center>
																										<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
																										<input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
																										<input type="hidden" name="link" value="<?php echo $link; ?>">
																										<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
																										<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
																										<button class="waves-effect waves-green btn-flat black-text" name="acao" value="alterar"><i class="material-icons right">send</i>Alterar</button>
																								</center>
																						</form>
																				</center>
																		</div>
																</div>
															</td>
															<!-- Excluir -->
															<td>
																	<a class="waves-effect waves-light modal-trigger red-text" href="#excluir<?php echo $row['codigo'] ;?>"><i class="material-icons">clear</i></a>
																	<div id="excluir<?php echo $row['codigo'] ;?>" class="modal" style="width: 350px;">
																			<div class="modal-content">
																					<center>
																							<h4>Confirmar Exclusão!</h4>
																							<p>Deseja realmente excluir esse registro?<br />Essa operação não poderá ser desefeita</p>
																							<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
																							<a href="acao.php?acao=excluir&token=<?php echo $_SESSION['token'] ?>&codigo=<?php echo $row['codigo']; ?>&tabela=<?php echo $tabela; ?>&link=<?php echo $link; ?>" class="modal-action waves-effect waves-teal btn-flat">Confirmar</a>
																					</center>
																			</div>
																	</div>
															</td>
													</tr>
													<?php }
														$dbh = null;
													?>
											</tbody>
									</table>
							</div>
					</div>
        </div>
      </div>
    </main>

    <footer></footer>

    <!-- Scripts -->
    <script src="../assets/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
    </script>
  </body>

  </html>