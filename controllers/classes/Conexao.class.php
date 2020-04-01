<?php

// Uso: $pdo = Conexao::conexao();
// $pdo->prepare("SELECT * FROM tabela"); etc
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class Conexao {
	protected static $conexao;

	private function __construct ()	{
		$db_host = "185.224.138.217";
		$db_nome = "u729591583_mrt";
		$db_usuario = "u729591583_prod";
		$db_senha = "martinaeramon";
		$db_driver = "mysql";

        date_default_timezone_set('America/Sao_Paulo');

        $GLOBAL['tbAlbum'] = 'Album';
        $GLOBAL['tbFotos'] = 'Fotos';
        $GLOBAL['tbClipes'] = 'Clipes';

		try	{
			self::$conexao = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
			self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$conexao->exec("SET NAMES utf8");
		}
		catch (PDOException $e) {
			die("Erro de conexão: ".$e->getMessage());
		}
	}

	public static function conexao() {
		if (!isset(self::$conexao)) {
			new self;
		}
		return self::$conexao;
	}
}

?>