<?php
require_once "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Check if all fields are filled
    if (empty($username) || empty($password) || empty($confirm_password)) {
        echo "All fields are required!";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM new_user WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username is already taken!";
        $stmt->close();
        exit();
    }
    $stmt->close();

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO new_user (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.html");
        exit();
    } else {
        echo "Something went wrong. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
