<?php

//Anon, PHP login logout example with session. Available at: https://www.studentstutorial.com/php/login-logout-with-session [Accessed September 21, 2022]. 
// firstly the session is started
session_start();
//session is unset through in-built function
session_unset();
//all sessions inwebsite gets destroyed
session_destroy();

header("Location:index.php");// throws to index page

?>
