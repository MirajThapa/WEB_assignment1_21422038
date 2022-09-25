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
        // gets the id of the category that needs to be updated
    		$edit_category_id = $_GET['cat_edit'];
            // sql query to gets the values from the category table from database
    		$sql = $setDb->prepare("
    			SELECT category_id,name FROM category WHERE category_id=$edit_category_id;
    			");

    		$sql->execute();
    	 ?>
         <!-- form to update the category that has been selected to be edited -->
    	 <form action="function.php" method="POST" enctype="multipart/form-data">
            <h3> Update Category Name </h3>
    	 	<label>
    	 		Name of Category
    	 	</label>
            <!-- loop executed to fill the values that needs to be edited -->
    	 	<?php foreach($sql as $value ){ ?>
                <!-- name of category with the data that needs to be edited -->
    	 		<input type="text" name="updation_cat" required="" value=<?php echo $value['name'] ?>>
                <!-- gets the category_id -->
    	 		<input type="hidden" name="updation_cat_id" value=<?php echo $value['category_id'] ?>>

    	 	<?php } ?>
                <!-- to edit the category -->
    	 		<input type="submit" name="edit_category_times">

    	 </form>

	</main>

    <?php
    // included the footer side of the website
            include_once "footer.php";
        ?>

</body>
</html>