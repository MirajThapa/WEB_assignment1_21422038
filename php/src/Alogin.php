<?php
// included the header section of the page
include_once "allNav.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<main>

			<?php require 'sideBar.php';//added the links in the sidebar section ?>

			<h3>Admin Login</h3>
			<!-- login form for the admin -->
			<form method="POST" action="function.php">
				<!-- gets the email  -->
	            <label>E-mail</label>
	            <input type="text"  name="admin_mail_part" placeholder="Enter your email" required="">
	            
	            <!-- gets the password -->
				<label>Password</label>
	            <input type="password"  name="admin_code_part" placeholder="Enter your password" required="">
	            <!-- submit button for the admin login section -->
	            <input type="submit" name="login_through_admin" value="Submit" >
			</form>

		</main>

		<?php
			require 'footer.php';
		?>

	</body>
</html>
