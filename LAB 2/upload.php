<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['news-file']) && $_FILES['news-file']['error'] === UPLOAD_ERR_OK) {
        // Define the path to save the uploaded JSON file
        $uploadDir = './Lab1fardig';
        $uploadFile = $uploadDir . 'data.json';

        if (move_uploaded_file($_FILES['news-file']['tmp_name'], $uploadFile)) {
            // Read and validate the uploaded JSON file
            $jsonData = file_get_contents($uploadFile);
            $jsonArray = json_decode($jsonData, true);

            // Check if JSON decoding was successful
            if ($jsonArray === null && json_last_error() !== JSON_ERROR_NONE) {
                echo 'Error: Invalid JSON format.';
                exit;
            }

            // Validate the JSON structure
            if (validateJsonStructure($jsonArray)) {
                echo 'News JSON file uploaded and validated successfully!';
                header('Location: hadelandheba.php');
                exit;
            } else {
                echo 'Error: JSON file does not contain the required structure.';
               
                unlink($uploadFile);//delete the wrong file
            }
        } else {
            echo 'Error: Failed to upload the file.';
        }
    } else {
        echo 'Error: No file uploaded.';
    }
} else {
    echo 'Invalid request method.';
}
function validateJsonStructure($jsonArray) {

    // Check if 'news' is an array with valid items
    if (isset($jsonArray['news']) && is_array($jsonArray['news'])) {
        foreach ($jsonArray['news'] as $newsItem) {

            // Check required fields for each news item
            if (!isset($newsItem['title']) || !isset($newsItem['imgurl']) || !isset($newsItem['content'])) {
                return false; 
            }
        }
    } else {
        return false; 
    }

   
    if (!isset($jsonArray['hovbox']) || 
        !isset($jsonArray['hovbox']['hover_text']) || 
        !isset($jsonArray['hovbox']['blue_box_text']) || 
        !isset($jsonArray['hovbox']['image_url']) || 
        !isset($jsonArray['hovbox']['content'])) {
        return false; 
    }

   
    if (!isset($jsonArray['white_box3']) || 
        !isset($jsonArray['white_box3']['header_text']) || 
        !isset($jsonArray['white_box3']['list_items']) || 
        !is_array($jsonArray['white_box3']['list_items']) || 
        !isset($jsonArray['white_box3']['links']) || 
        !is_array($jsonArray['white_box3']['links'])) {
        return false; 
    }

    
    foreach ($jsonArray['white_box3']['links'] as $link) {
        if (!isset($link['text']) || !isset($link['url'])) {
            return false; 
        }
    }

    
    if (!isset($jsonArray['box5']) || 
        !isset($jsonArray['box5']['header_text']) || 
        !isset($jsonArray['box5']['content']) || 
        !isset($jsonArray['box5']['links']) || 
        !is_array($jsonArray['box5']['links'])) {
        return false; 
    }

    
    foreach ($jsonArray['box5']['links'] as $link) {
        if (!isset($link['text']) || !isset($link['url'])) {
            return false; 
        }
    }

   
    if (!isset($jsonArray['box7']) || 
        !isset($jsonArray['box7']['image_url'])) {
        return false; 
    }

    return true;
}
?>
