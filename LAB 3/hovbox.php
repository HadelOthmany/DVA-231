<?php
require_once "dbcon.php";

$sql = "SELECT hover_text, blue_box_text, image_url, content FROM hovbox ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $hovbox = $result->fetch_assoc();
    echo json_encode($hovbox);
}
?>