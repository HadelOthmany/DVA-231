<?php
require_once "dbcon.php";

// Fetch the latest 3 news articles
$sql = "SELECT title, imgurl, content FROM news ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);

$news = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}

echo json_encode($news);

$conn->close();
?>
