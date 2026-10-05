<?php
session_start();
$_SESSION['isLoggedIn'] = false;
session_unset(); 
session_destroy(); 
header('Location: hadelandheba.php');  
exit();
?>
