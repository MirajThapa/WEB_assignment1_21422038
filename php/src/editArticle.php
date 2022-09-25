<?php

// session is started 
session_start();
// require keyword used to gets the header page
require 'navigation.php';
// connecting to the database
include_once("dbConnection.php");
$setDb = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Updation</title>
</head>
<body>
	<main>
        <!-- logout button created -->
		<nav>
	      <ul>
	          <li><a href="logout.php">Logout</a></li>
	      </ul>
    	</nav>

    	<?php
        // gets the id of the article that needs to be updated
    		$edit_article_id = $_GET['article_edition'];
            // sql query to gets the values from the article table from database
    		$sql_query = $setDb->prepare("
    			SELECT article_id,title,content,articlePhoto,categoryId FROM article WHERE article_id=:edit_article_id;
    			");
            // binding the values
            $sql_query->bindParam(":edit_article_id",$edit_article_id);
            // execute the query
    		$sql_query->execute();
    	 ?>

         <!-- form to update the article that has been selected to be edited -->
    	 <form action="function.php" method="POST" enctype="multipart/form-data">
            <h3> Update Article</h3>
            <!-- loop executed to fill the values that needs to be edited -->
    	 	<?php foreach($sql_query as $value ){ ?>
                <!-- hidden article_id -->
                <input type="hidden" name="updation_id" value=<?php echo $value['article_id'] ?>>

                <label> Title </label>
                <!-- title with the data that needs to be edited -->
                <input type="text" name="updation_title" required="" value="<?php echo $value['title'] ?>">
            
                <label> Content </label>
                <!-- contents with the data that needs to be edited -->
                <textarea name="updation_contents" required=""> <?php echo $value['content'] ?></textarea>

                <label>Article Photo</label> 
                <!-- photo of the article -->
                <input type="file" name="upadation_photo_article" required="" value="<?php echo $value['articlePhoto'] ?>">

                <?php
                // to edit the category side of the article
                $sql = $setDb->prepare("SELECT category_id,name FROM category; ");
                $sql->execute();

                ?>
                <label>Category</label>
                <select name="updation">
                    <!-- loop for the category present in website -->
                    <?php foreach($sql as $val ){ ?>
                <!-- values shows in categories -->
                  <option value=<?php echo $val['category_id'] ?> ><?php echo $val['name']; ?></option>
                  <?php } ?>
                </select>
                <br>
                <!-- update article submit button -->
    	 		<input type="submit" name="updation_of_article" value="update article">

                <?php } ?>

    	 </form>

	</main>

    <?php
    // included the footer side of the website
            include_once "footer.php";
        ?>

</body>
</html>