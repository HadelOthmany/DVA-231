<?php
$conn = new mysqli("localhost", "root", "", "lab3db");
if($conn->connect_errno){
    echo json_encode(['error' => $conn->connect_errno]);
    exit();
}
?>
