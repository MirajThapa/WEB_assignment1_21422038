<?php

require 'dbConnection.php';// require keyword used to connect to the database page 
$sql_connect = configuration::connection_database();

	$article_deleteion = $_GET['article_deleteion'];// article_id fetched 
	// check the function is true or not
	if(delete($sql_connect,$article_deleteion)){
		header("Location:adminArticles.php");
	}

	// function to delete the article
	function delete($sql_connect,$article_deleteion){

		// sql query to delete the article refreanced to the article_id
		$term=$sql_connect->prepare("DELETE FROM article WHERE article_id=:article_id");
		$term->bindParam(":article_id",$article_deleteion);
		return $term->execute();
	}

?>