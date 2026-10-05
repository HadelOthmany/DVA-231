<?php
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin
header('Content-Type: application/json; charset=utf-8');

// Read the JSON file
$data = file_get_contents('Lab1fardigdata.json');



// Decode the JSON data
$json_data = json_decode($data, true);


echo json_encode($json_data);
?>
