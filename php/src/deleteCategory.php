<?php

// require keyword used to connect to the database page
require 'dbConnection.php';
$sql_con = configuration::connection_database();

	$delete_term = $_GET['cat_delete'];// article_id fetched 

// check the function is true or not
	if(categoryDeletion($sql_con,$delete_term)){
		// delete all the articles under the category
		if(articleDeletion($sql_con,$delete_term)){
			header("Location:adminCategories.php");
		}	
	}
// function to delete the category
	function categoryDeletion($sql_con,$delete_term){
		// sql query to delete the article refrenced to the article_id
		$sql_term=$sql_con->prepare("DELETE FROM category WHERE category_id=:category_id");
		$sql_term->bindParam(":category_id",$delete_term);
		return $sql_term->execute();	
	}
//function to delete the article related to the article 
	function articleDeletion($sql_con,$delete_term){
		// sql query to delete the article refreanced to the category_id
		$sql_term=$sql_con->prepare("DELETE FROM article WHERE categoryId=:category_id");
		$sql_term->bindParam(":category_id",$delete_term);
		return $sql_term->execute();
	}

?>