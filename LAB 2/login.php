<?php
session_start();

// Simulate user authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // accept any username and password 
    if (!empty($username) && !empty($password)) {

        // Set session variables to mark the user as logged in
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['username'] = $username;

        // Redirect to the admin page after login
        header('Location: admin.php');
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>
