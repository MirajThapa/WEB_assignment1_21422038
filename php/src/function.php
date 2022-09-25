<?php
// starting the session in this page
session_start();
// including the database connection page
include_once("dbConnection.php");
$sql_con=configuration::connection_database();

// gets the admin login button click event
if (isset($_POST['login_through_admin'])) {

	// gets the mail and password entered by the admin
	$a_uname= $_POST['admin_mail_part'];
	$a_code=$_POST['admin_code_part'];

	// check if the credentials are correct
	if (loginAdmin($sql_con,$a_uname,$a_code)) {

		$_SESSION["username_of_admin"] = $a_uname;// sets the sesssion of the admin name
		header("Location:adminArticles.php");// throws in the another page
	}

}

// function to check the credentials of admin login
function loginAdmin($dbcon,$admin_uname,$admin_pcode){
	// query to get the data from the admin table
	$query=$dbcon->prepare("
		SELECT admin_uname,admin_pcode FROM admin WHERE admin_uname=:admin_uname AND admin_pcode=:admin_pcode
		");
	// binding the data
	$query->bindParam(":admin_uname",$admin_uname);
	$query->bindParam(":admin_pcode",$admin_pcode);

	return $query->execute();
}

// gets the user login button click event
if (isset($_POST['login_through_user'])) {
	// gets the mail and password entered by the user
	$u_uname= $_POST['user_mail_part'];
	$u_code=$_POST['user_code_part'];
	//checks the function bool form
	$user = userPart($sql_con,$u_uname);
	// fetching the daya
	$row = $user->fetch();

		if(password_verify($u_code, $row['password'])) { //getting the hashed password and checking credentials
			$_SESSION["username_of_user"] = $u_uname;// setting the session of user mail

			// sql query to get data of user from database
		$db_query=$sql_con->prepare("SELECT user_id,user_email,user_name FROM person WHERE user_email=:user_email LIMIT 1" );
		$val = ['user_email' => $u_uname];
		$db_query->execute($val);// executing the query

		$user_name_sec = $db_query->fetch(PDO::FETCH_OBJ);
		
		$_SESSION["selected_user"]=$user_name_sec->user_name;// setting the session of user name
		$_SESSION["selected_user_id"]=$user_name_sec->user_id;// setting the session of user id

		header("Location:index.php");// throws to the index page
		}
	

}

// function to check the user login credentials
function userPart($dbcon,$admin_uname){
	// getting the email and password from person table
	$sql=$dbcon->prepare("
		SELECT user_email,password FROM person WHERE user_email=:admin_uname
		");
	$sql->bindParam(":admin_uname",$admin_uname);

	 $sql->execute();
	 return $sql;
}


// gets the event to add the category
if (isset($_POST['add_the_category'])) {
	$category_name = $_POST['name_of_category_here'];// gets the category name entered by admin

	//function called
	if(addCategory($sql_con,$category_name)){
		header("Location:addCategory.php");// headed to another page
	}
}

//add the category function
function addCategory($connection,$name_of_category){
	// query to insert into the category section in database
	$sql=$connection->prepare("
		INSERT INTO category(name) VALUES(:name)
		");

	//binding the parameter
	$sql->bindParam(":name",$name_of_category);

	return $sql->execute();
}

//if the edit category is selected
if (isset($_POST['edit_category_times'])) {
	// gets the category id that needs to be updated
		$edit_category = $_POST['updation_cat_id'];
		$data_update=$_POST['updation_cat']; 

		//checks the function execution
	if(categoryUpdation($sql_con,$edit_category,$data_update)){
		header("Location:adminCategories.php");	// throws in another page	
	}
}

// function for updation of category
function categoryUpdation($connect,$edit_category,$data_update){
	// database query to update the name column of category
	$sql=$connect->prepare("
		UPDATE category SET name=:name WHERE category_id = :category_id LIMIT 1
		");
	//binding the parameter
	$sql->bindParam(":category_id",$edit_category);
	$sql->bindParam(":name",$data_update);

	return $sql->execute();
}

// if the article is added in website

//Anon, 2018. How to upload image in database using PHP MySQLi in hindi | display image in php mysql in Hindi. YouTube.
// Available at: https://www.youtube.com/watch?v=wbDMsztk32Q [Accessed September 21, 2022]. 
if(isset($_POST['add_the_article_here'])){

	// data filled by the admin for the article
	$given_title= $_POST['given_title'];
	$given_contents=$_POST['given_contents'];
	$cat_term=$_POST['cat_term'];
	$given_photo=$_FILES['given_photo'];
	$published_date = date('l jS \of F Y h:i:s A'); // date of article published.. in-built function

	// for the image section
	$filename=$given_photo['name'];
	$filepath=$given_photo['tmp_name'];
	$fileerror=$given_photo['error'];

	if($fileerror==0){// if file doesn't throws error
		$path='images/articles/'.$filename;
		move_uploaded_file($filepath, $path);// uploade the image into articles folder

//checks for the function
		if(adding_the_article($sql_con,$given_title,$given_contents,$cat_term,$published_date,$path)){
			header("Location:addArticle.php");// throws in another page
		}

	}
}

// function for adding the articles
function adding_the_article($connection,$given_title,$given_contents,$cat_term,$published_date,$path){
	//query to insert the data in the article table
	$sql= $connection->prepare("
		INSERT INTO article(title,content,publishDate,categoryId,articlePhoto) VALUES
		(:given_title,:given_contents,:published_date,:categoryId,:articlePhoto)");

	//binding the data
	$sql->bindParam(":given_title",$given_title);
	$sql->bindParam(":given_contents",$given_contents);
	$sql->bindParam(":categoryId",$cat_term);
	$sql->bindParam(":articlePhoto",$path);
	$sql->bindParam(":published_date",$published_date);

	return $sql->execute();

}

// for registering the new user for website
if(isset($_POST['register_the_user'])){

	// takes the mail,user_name and password from the form that user filled
	$user_mail= $_POST['mail_of_user'];
	$user_name=$_POST['name_of_user'];
	$user_password=password_hash($_POST['passcode_user'], PASSWORD_DEFAULT);

	//checks for the function
	if(user_added($sql_con,$user_mail,$user_name,$user_password)){
		header("Location:index.php");// throws in index page
	}
}

// function for adding the user
function user_added($connection,$user_mail,$user_name,$user_password){
	// database query to insert into person table
	$sql= $connection->prepare("
		INSERT INTO person(user_email,password,user_name) VALUES
		(:email,:password,:user_name)");

	// binding the data
	$sql->bindParam(":email",$user_mail);
	$sql->bindParam(":password",$user_password);
	$sql->bindParam(":user_name",$user_name);

	return $sql->execute();

}

// for updation of article
if(isset($_POST['updation_of_article'])){

	// gets the data filled by admin for updation
	$updation_id = $_POST['updation_id'];
	$updation_title= $_POST['updation_title'];
	$updation_contents=$_POST['updation_contents'];
	$updation_category=$_POST['updation'];
	$upadation_photo_article=$_FILES['upadation_photo_article'];
	$date_of_updated = date('l jS \of F Y h:i:s A');

// for the image section
	$filename=$upadation_photo_article['name'];
	$filepath=$upadation_photo_article['tmp_name'];
	$fileerror=$upadation_photo_article['error'];

	if($fileerror==0){// if image doesn't throws error
		$path='images/articles/'.$filename;
		//echo "$destination";
		move_uploaded_file($filepath, $path);// moves the image into the articles folder

		// check if the article is update
		if(article_update_term($sql_con,$updation_id,$updation_title,$updation_contents,$updation_category,$path,$date_of_updated)){
			header("Location:adminArticles.php");// throws to another page
		}

	}
}

// function for updation of article
function article_update_term($sql_con,$updation_id,$updation_title,$updation_contents,$updation_category,$path,$date_of_updated){
	//database query to update the article in database
	$dbquery=$sql_con->prepare("
		UPDATE article SET title=:updation_title,content=:updation_contents,publishDate=:date_of_updated,articlePhoto=:path,categoryId=:updation_category WHERE article_id = :updation_id LIMIT 1
		");
	// binding the parameters
	$dbquery->bindParam(":updation_id",$updation_id);
	$dbquery->bindParam(":updation_title",$updation_title);
	$dbquery->bindParam(":updation_contents",$updation_contents);
	$dbquery->bindParam(":date_of_updated",$date_of_updated);
	$dbquery->bindParam(":path",$path);
	$dbquery->bindParam(":updation_category",$updation_category);

	return $dbquery->execute();
}


//for adding the comments
if(isset($_POST['added_of_comments'])){

	//gets the comment data filled by user
	$id_of_article= $_POST['automation_id_article'];
	$selected_user_id=$_POST['selected_user_id'];
	$selected_user=$_POST['selected_user'];
	$commenting_section=$_POST['commenting_section'];

	// check for the function
	if(comments_displayed($sql_con,$id_of_article,$selected_user_id,$selected_user,$commenting_section)){
		header("Location:index.php");
	}
}

//function for adding the comments
function comments_displayed($sql_con,$id_of_article,$selected_user_id,$selected_user,$commenting_section){
	// database query to insert into comments table
	$query= $sql_con->prepare("
		INSERT INTO comments(username,user_id,article_id,content) VALUES
		(:username,:user_id,:article_id,:content)");

	// binding the parameter
	$query->bindParam(":username",$selected_user);
	$query->bindParam(":article_id",$id_of_article);
	$query->bindParam(":content",$commenting_section);
	$query->bindParam(":user_id",$selected_user_id);

	return $query->execute();

}



?>