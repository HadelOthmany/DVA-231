<?php 
require_once "dbcon.php";

$sql="select id,image_url from box7 order by id desc limit 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    echo json_encode($row);
}


$conn->close();
?>