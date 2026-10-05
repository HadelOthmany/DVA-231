<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');

require_once "dbcon.php";

$query = isset($_GET['q']) ? $_GET['q'] : '';

$stmt = $conn->prepare("SELECT * FROM news WHERE title LIKE CONCAT('%', ?, '%') ORDER BY id DESC LIMIT 5");
$stmt->bind_param("s", $query); 
$stmt->execute();
$result = $stmt->get_result();

$newsItems = [];
// Escape special characters in the query term for regular expression
$escapedQuery = preg_quote($query, '/');

while ($row = $result->fetch_assoc()) {
    $highlightedTitle = preg_replace("/($escapedQuery)/i", "<span style='color:red;'>$1</span>", $row['title']);
    
    $newsItems[] = [
        'id' => $row['id'],
        'title' => $highlightedTitle,
        'url' => 'result.php?id=' . $row['id'] // Construct URL using the news ID
    ];
}

echo json_encode($newsItems);

$stmt->close();
$conn->close();
?>
