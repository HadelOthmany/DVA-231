<?php require_once "dbcon.php";

// Fetch the latest box5 data
$sql = "SELECT id, header_text, content FROM box5 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $box5 = $result->fetch_assoc();
    
    $box5_id = $box5['id'];
    $linksQuery = "SELECT text, url FROM box5_links WHERE box5_id = $box5_id";
    $linksResult = $conn->query($linksQuery);
    
    $links = [];
    
    if ($linksResult && $linksResult->num_rows > 0) {
        while ($linkRow = $linksResult->fetch_assoc()) {
            $links[] = $linkRow; // Add each link (text and url) to the links array
        }
    }
    
    // Add the links array to the box5 data
    $box5['links'] = $links;
    
    echo json_encode($box5);
}