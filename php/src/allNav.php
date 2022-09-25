<?php
//included the database and connect through it
include_once("dbConnection.php");
$sql_part = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Latest Articles</a></li>
				<li><a href="#">Select Category</a>
					<ul>

						<?php
						// gets the category name to go to their side of page
				            $sql= $sql_part->prepare("
				              SELECT category_id,name FROM category
				              ");

				            $sql->execute();
				            // loop to gets the name of category in the website
			             foreach($sql as $need){ ?>
			             	<!-- throws in the category page related to the specified one -->
						<li><a class="articleLink" href="category.php?newPage=<?php echo $need['category_id'];?>"><?php echo $need['name']; ?></a></li>
					<?php } ?>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- banner for the website -->
		<img src="images/banners/randombanner.php" />
	
	</body>
</html>