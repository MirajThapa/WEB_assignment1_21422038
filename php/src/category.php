<?php

// session is started in this page
session_start();
// included the header file
include_once("allNav.php");
// connecting to the database
include_once("dbConnection.php");
$setDb = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<main>
			<?php
			// checks if the user is logged in or not
				if(isset($_SESSION['username_of_user'])){  ?>
					<!-- shows the logoout button if user is logged in -->
						<nav>
							<ul>
							    <li><a href="logout.php">Logout</a></li>
						    </ul>
						</nav>
			<?php
				}
				else{
					//if the user isnot logged in it shows normal siderBar page
					include 'sideBar.php';
				}
			?>

			<?php
			// gets the id of the category
			$num_category = $_GET['newPage'];
			// database query to get the data from the article page refrenced from the category_id
				$sql_part= $setDb->prepare("
				        SELECT * FROM article WHERE categoryId = $num_category ORDER BY article_id DESC;
				    ");
				$sql_part->execute();
			?>  

			<article>
				<!-- loop to get the article title with the link to throw in article page -->
				<?php foreach($sql_part as $val ){ ?>

				<h3><a class="articleLink" href="article.php?partitionArticle=<?php echo $val['article_id'];?>"><?php echo $val['title']; ?></a></h3>
				<!-- gets the date of published of article -->
				<h4><?php echo $val['publishDate'] ?></h4>
				<br>

			<?php } ?>

				
			</article>

		
		</main>

		<?php
		// included the footer page
			include_once "footer.php";
		?>

	</body>
</html>
