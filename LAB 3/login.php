<?php
require_once "dbcon.php"; 

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!(isset($_POST['username']) && isset($_POST['password']))) {
        die("Method Not Allowed");
    }

    $sql = "SELECT id, password FROM new_user WHERE name = ?";

    // Create a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $_POST['username']);
        
        $stmt->execute();
        
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            // Bind the result (user id and hashed password)
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $hashed_password)) {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['id'] = $user_id;

                header("Location: admin.php");
                exit();  
            } else {
                
                echo "Invalid login credentials.";
                die();
            }
        } else {
          
            echo "Invalid login credentials.";
            die();
        }

        $stmt->close();
    } else {
    
        echo "Database error: " . $conn->error;
        die();
    }
}

http_response_code(405);  
?>
