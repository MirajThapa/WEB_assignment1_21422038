<?php
// class created for database configuration
class configuration{
	public static function connection_database(){
		$server="db";
		$user="root";
		$password="MYSQL_ROOT_PASSWORD";
		$database_name="assignment1";

		$connection=new PDO("mysql:host=$server;dbname=$database_name",$user,$password);
		$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);	

		return $connection;
	}
}

?>