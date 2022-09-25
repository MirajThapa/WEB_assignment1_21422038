<?php

// started the session
session_start();
include_once("allNav.php");// included the navigation section
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
			// checks if the user is logged in or not
				if(isset($_SESSION['username_of_user'])){ 
					?>
					<!-- if user is logged in then it shows logout button -->
						<nav>
							<ul>
							    <li><a href="logout.php">Logout</a></li>
						    </ul>
						</nav>
			<?php
				}
				else{
					//otherwise it shows..
					include 'sideBar.php';
				}
			?>

			<?php
			// gets the id of the user
			$comment_user= $_GET['user_who_cmt'];
			//query to get the data from comments table through specified user
				$sql_part= $setDb->prepare("
				        SELECT * FROM comments WHERE user_id=$comment_user;
				    ");
				$sql_part->execute();
			?>  

			<article>

				<h3>All Comments</h3>
				<br>
				<!-- loop to get the comments entered by selective user throughout the website -->
				<?php foreach($sql_part as $val){ ?>
				<ul>
					<li><h4><?php echo $val['content'] ?></h4></li>
				</ul>
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
