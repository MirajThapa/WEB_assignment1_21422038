<?php
// starting the session
session_start();
include_once("allNav.php");//including the navigation part
include_once("dbConnection.php");// connecting to the database
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
			// checks if the user is logged in
				if(isset($_SESSION['username_of_user'])){ 
					?>
					<!-- if user is logged in, it shows logout button -->
						<nav>
							<ul>
							    <li><a href="logout.php">Logout</a></li>
						    </ul>
						</nav>
			<?php
				}
				else{
					//otherwise login button is presented
					include 'sideBar.php';
				}
			?>

			<?php
			//sql query to get the data from the article table
				$sql_part= $setDb->prepare("
				        SELECT * FROM article ORDER BY article_id DESC LIMIT 10;
				    ");
				$sql_part->execute();
			?>  

			<article>
				<!-- loop to get the article title and published date -->
				<?php foreach($sql_part as $val){ ?>

				<h3><?php echo $val['title']; ?></h3>

				<p><?php echo $val['publishDate'] ?></p>
				<br>

			<?php } ?>

				
			</article>

		
		</main>

		<?php
		// included the footer section
			include_once "footer.php";
		?>

	</body>
</html>
