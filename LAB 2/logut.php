<?php
session_start();
$_SESSION['isLoggedIn'] = false; //make sure its false
session_unset(); //unsett all variable
session_destroy();  // Destroy the session to log out the user
header('Location: hadelandheba.php');  
exit();
?>
