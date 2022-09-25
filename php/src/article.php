<?php

session_start();// session gets started for the page
require 'allNav.php';// added the header side for the page
include_once("dbConnection.php");// connecting to the database
$sql_part = configuration::connection_database();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Article page</title>
</head>
<body>
	<main>
			<?php
			// check if the user is logged in or not
				if(isset($_SESSION['username_of_user'])){  ?>
					<!-- if logged in then shows the logout button -->
						<nav>
							<ul>
							    <li><a href="logout.php">Logout</a></li>
						    </ul>
						</nav>
			<?php
				}
				else{
					// if user isnot logged in then shows the login button
					include 'sideBar.php';
				}
			?>


			<?php
			// gets the article_id that has been clicked
			$num_article= $_GET['partitionArticle'];

			// sql query to fetch the data of article selected
			$database_query = $sql_part->prepare("SELECT * FROM article WHERE article_id = $num_article ;");
			// sql query to fetch the comments added for selected article
			$database_query_two = $sql_part->prepare("SELECT * FROM comments WHERE article_id = $num_article ;");

			//query executed
			$database_query->execute();
			$database_query_two->execute();

			?>

			<article>
				<!-- loop added to get the data of the article that has been selected -->
				<?php foreach($database_query as $val ){ ?>
					<!-- gets the title -->
				<h2><?php echo $val['title'] ?></h2>
				<!-- gets the published date of article -->
				<h4><?php echo $val['publishDate'] ?></h4>
				<br>
				<!-- gets the content added for the article -->
				<p><?php echo $val['content'] ?></p>
				<!-- gets the article image -->
				<img src="<?php echo $val['articlePhoto']; ?>" width="400px" height="400px">
				<br>
				<br>

				<h2>Comments</h2>

				<!-- loop to list out the comments in the article -->
				<?php foreach($database_query_two as $comment_section ){ ?>
					<!-- link of user name to get the comments added by them in this website -->
					<h3><a href="userComments.php?user_who_cmt=<?php echo $comment_section['user_id'];?>"><?php echo $comment_section['username']; ?></a></h3>

					<p><?php echo $comment_section['content']; ?></p>
					<br>
				<?php }
				//checks if the user is logged in
				if(isset($_SESSION['username_of_user'])){
				 ?>
				 <!-- shows the form to add comments if user is logged in -->
					<form action="function.php" method="POST" enctype="multipart/form-data">

						<input type="hidden" name="automation_id_article" value=<?php echo $val['article_id']; ?>>
						<!-- gets the user_id which is set in the session -->
						<input type="hidden" name="selected_user_id" value=<?php echo $_SESSION['selected_user_id']; ?>>
						<!-- gets the user_name which is set in the session -->
						<input type="hidden" name="selected_user" value=<?php echo $_SESSION['selected_user']; ?>>
						<label class="p_box">Type Comment: </label>
						<!-- section to write comment -->
						<textarea name="commenting_section" required="required"></textarea>	
								     <!-- button to add the comment -->
						<input type="submit" name="added_of_comments" value="Add Comment">
										 	
					</form>

					<?php } ?>

				<?php } ?>

			</article>
	</main>

	<?php
	// included the footer section
			include_once "footer.php";
		?>

</body>
</html>