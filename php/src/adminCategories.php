<?php

// session gets started in the website
session_start();
// require keyword is used to get the navigation side page
require 'navigation.php';

// connecting to the database
include_once("dbConnection.php");
$setDb = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>
</head>
<body>
	<main>

		<!-- logout button to destroy the session of the page -->
		<nav>
			<ul>
			    <li><a href="logout.php">Logout</a></li>
		    </ul>
		</nav>

		<!-- table to show the listed categories in the website -->
		<table>
            <tr>
              <td><h3>Category List</h3></td>
              <td><h3>Delete</h3></td>
              <td><h3>Edit</h3></td>
            </tr>

		<?php

		//selecting the category type for the article
		$sql= $setDb->prepare("SELECT * FROM category  ;");
		$sql->execute();

		// loop to fetch the data of category table in database
		foreach ($sql as $value) { ?>
			<tr>
			<td><h4><?php echo $value['name']; ?></h4></td>
			<!-- link to throw in the deletion side of the category -->
            <td><a href="deleteCategory.php?cat_delete=<?php echo $value['category_id'];?>">Delete</a></td>
            <!-- link to throw in the updation side of the category -->
            <td><a href="editCategory.php?cat_edit=<?php echo $value['category_id'];?>">Edit</a></td>
            </tr>

        	<?php } ?>
        </table>

		

	</main>

	<?php
	// included the footer
		include_once "footer.php";
	?>

</body>
</html>

