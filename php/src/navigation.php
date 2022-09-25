<?php
// not set session of admin 
if(!isset($_SESSION['username_of_admin'])){
	header("Location:index.php");// throws to index page
}

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
				<!-- links to the different page -->
				<li><a href="adminArticles.php">All Articles</a></li>
				<li><a href="addArticle.php">Add Articles</a></li>
				<li><a href="addCategory.php">Add Category</a></li>
				<li><a href="adminCategories.php">All Categories</a></li>
			</ul>
		</nav>
		<!-- image banner for header -->
		<img src="images/banners/randombanner.php" />
	
	</body>
</html>