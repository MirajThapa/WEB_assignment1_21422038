<?php

include_once "allNav.php";// included the navigation section for page

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<main>
			<?php require 'sideBar.php'; //included the side bar ?>

			<h3>Register User</h3>

			<!-- form to add the user in website -->
			<form method="POST" action="function.php">
				<label>Name</label>
				<!-- gets the users name -->
	            <input type="text"  name="name_of_user" required="" placeholder="Write Your name">

	            <label>E-mail</label>
	            <!-- gets the users mail -->
	            <input type="text"  name="mail_of_user" required="" placeholder="Write your Email">

				<label>Password</label>
				<!-- gets the users password -->
	            <input type="password"  name="passcode_user" required="" placeholder="Enter your password">
	            
	            <!-- here we submit the form -->
	            <input type="submit" name="register_the_user" value="Sign up" >
			</form>

		
		</main>

		<?php
		// included the footer section
			include_once "footer.php";
		?>

	</body>
</html>
