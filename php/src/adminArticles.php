<?php

// starting the session 
session_start();
// aading the navigation section
require 'navigation.php';

// connection to database is made
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
		<!-- logout button to destroy the sessions that had been created -->
		<nav>
			<ul>
			    <li><a href="logout.php">Logout</a></li>
		    </ul>
		</nav>

		<?php
			// database query serches the data about the articles posted in the website
		$sql= $setDb->prepare("SELECT * FROM article  ;");
		$sql->execute();

		?>
		<article>
				<!-- fetch the data from the database -->
				<?php foreach ($sql as $value) { ?>
				<h2><?php echo $value['title'] ?></h2>
				<h4><?php echo $value['publishDate'] ?></h4>
				<p><?php echo $value['content'] ?></p>
				<!-- photo about the specific article is fetched from the database -->
				<img src="<?php echo $value['articlePhoto']; ?>" width="500px" height="500px">
				<br>
				<br>
				<!-- button link to throw in the deletion part of article -->
				<a href="deleteArticles.php?article_deleteion=<?php echo $value['article_id'];?>">Delete</a>

				<!-- button link to throw in the edition part of article -->
				<a href="editArticle.php?article_edition=<?php echo $value['article_id'];?>">Edit</a>

				<?php } ?>
			</article>

		

	</main>

	<?php
	// foorter for the website
		include_once "footer.php";
	?>

</body>
</html>

