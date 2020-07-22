<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class Connection {
	protected static $connection;

	private function __construct ()	{
		$db_host = "189.224.138.217";
		$db_nome = "u729591583_mrt";
		$db_usuario = "u729591583_prod";
		$db_senha = "martinaeramon";
		$db_driver = "mysql";

        date_default_timezone_set('America/Sao_Paulo');

		try	{
			self::$connection = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
			self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$connection->exec("SET NAMES utf8");
		}
		catch (PDOException $e) {
			return ("Connection failed");
		}
	}

	public static function connection() {
		if (!isset(self::$connection)) {
			new self;
		}
		return self::$connection;
	}
}

?>