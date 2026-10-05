<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <h1>Admin: Upload News JSON File</h1>
    
    <form id="upload-form" method="POST" action="upload.php" enctype="multipart/form-data">
        <input type="file" id="news-file" name="news-file" accept="application/json" />
        <button type="submit">Upload JSON</button>
        <a href="logut.php" class="logout-btn">Logout</a>
    </form>

    
</body>
</html>
