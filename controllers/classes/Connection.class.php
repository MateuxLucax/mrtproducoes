<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class Connection {
	protected static $connection;

	private function __construct ()	{
		$db_host = "";
		$db_nome = "";
		$db_usuario = "";
		$db_senha = "";
		$db_driver = "";

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