<?php
// starting the session
session_start();
require 'navigation.php';// adding the navigation part

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
		<!-- form to add the categories in the article -->
		<form action="function.php" method="POST" enctype="multipart/form-data">

	      	<div><h3>Add category here</h3></div>
	      	<label>Category Name</label>

	      	<!-- give the name of the category -->
	        <input type="text" name="name_of_category_here" required="">
	        <!-- submit button to add the category type -->
	        <input type="submit" name="add_the_category" value="Add Category">
    
    	</form>

	</main>

	<?php
	// including the footer part
		include_once "footer.php";
	?>

</body>
</html>

