<?php
//included the navigation section
include_once "allNav.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<main>
			<?php require 'sideBar.php'; // attached sidebar section?>

			<h3>User Login</h3>

			<!-- form for login by user -->
			<form method="POST" action="function.php">
	            <label>E-mail</label>
	            <!-- takes the mail section -->
	            <input type="text"  name="user_mail_part" required="required" placeholder="Enter your email">
	            
				<label>Password</label>
				<!-- takes the password section -->
	            <input type="password"  name="user_code_part" required="required" placeholder="Enter your password">
	            
	            <!-- submit section -->
	            <input type="submit" name="login_through_user" value="Submit" >
			</form>

		</main>

		<?php
		//included the footer part to the website
			require 'footer.php';
		?>

	</body>
</html>
