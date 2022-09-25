<?php

// starting the session
session_start();
// limited the code with the require term
require 'navigation.php';
require 'dbConnection.php';
// connection added to the database
$setDb = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>	
</head>
<body>
	<main>

<!-- logout button added for admin section -->
		<nav>
			<ul>
			    <li><a href="logout.php">Logout</a></li>
		    </ul>
		</nav>

<!-- form created to add the articles in the website -->
		<form action="function.php" method="POST" enctype="multipart/form-data">

	      	<div><h3>Add Article here</h3></div>
	      	<label>Title</label>
	      	<!-- taking the title input -->
	        <input type="text" name="given_title" required="">

	        <label>Contents</label>
	        <!-- taking the contents in the website article -->
	        <textarea name="given_contents" required=""></textarea>

	        <label>Category Type</label>
	        <?php

	        //selecting the category type for the article
	        $sql = $setDb->prepare("SELECT category_id,name FROM category;");
	        $sql->execute();

	        ?>

	        <select name="cat_term">

				<?php foreach($sql as $val ){ ?>
					<!-- shows option for the article categories -->
				<option value=<?php echo $val['category_id'] ?> ><?php echo $val['name']; ?></option>
				<?php } ?>

			</select>

			<!-- taking the photo of the respective article -->
			<label>Photo</label>
			<input type="file" name="given_photo" required="">

			<!-- submit button to add the article -->
	        <input type="submit" name="add_the_article_here" value="Add Article">
    
    	</form>

	</main>

	<?php
	// including the footer part
		include_once "footer.php";
	?>

</body>
</html>

