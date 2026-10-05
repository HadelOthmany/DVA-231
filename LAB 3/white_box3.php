<?php
require_once "dbcon.php";

$sql = "SELECT id, header_text FROM white_box3 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$whiteBox3 = [];
if ($result && $result->num_rows > 0) {
    $whiteBox3 = $result->fetch_assoc();

    $whiteBox3Id = $whiteBox3['id'];
    $listItemsQuery = "SELECT list_item FROM white_box3_list_items WHERE white_box3_id = $whiteBox3Id ORDER BY id";
    $listItemsResult = $conn->query($listItemsQuery);

    $listItems = [];
    while ($row = $listItemsResult->fetch_assoc()) {
        $listItems[] = $row['list_item'];
    }
    $whiteBox3['list_items'] = $listItems;

    $linksQuery = "SELECT text, url FROM white_box3_links WHERE white_box3_id = $whiteBox3Id ORDER BY id";
    $linksResult = $conn->query($linksQuery);

    $links = [];
    while ($row = $linksResult->fetch_assoc()) {
        $links[] = $row;
    }
    $whiteBox3['links'] = $links;
}

echo json_encode($whiteBox3);

$conn->close();
?>
