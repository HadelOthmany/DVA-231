<?php

session_start();
require_once "dbcon.php";

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['jsonFile']) && $_FILES['jsonFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['jsonFile']['tmp_name'];
        $fileName = $_FILES['jsonFile']['name'];
        
        // Read the content of the uploaded JSON file
        $jsonFileContent = file_get_contents($fileTmpPath);
        
        $jsonArray = json_decode($jsonFileContent, true);

        // Check if the JSON is valid and contains the required structure
        if (json_last_error() === JSON_ERROR_NONE && validateNewsJsonStructure($jsonArray)) {
            
            // Insert news items
            if (isset($jsonArray['news'])) {
                foreach ($jsonArray['news'] as $newsItem) {
                    $title = $conn->real_escape_string($newsItem['title']);
                    $imgurl = $conn->real_escape_string($newsItem['imgurl']);
                    $content = $conn->real_escape_string($newsItem['content']);
                    
                    $sql = "INSERT INTO news (title, imgurl, content) VALUES ('$title', '$imgurl', '$content')";
                    $conn->query($sql);
                }
            }

            // Insert hovbox data
            if (isset($jsonArray['hovbox'])) {
                $hover_text = $conn->real_escape_string($jsonArray['hovbox']['hover_text']);
                $blue_box_text = $conn->real_escape_string($jsonArray['hovbox']['blue_box_text']);
                $image_url = $conn->real_escape_string($jsonArray['hovbox']['image_url']);
                $content = $conn->real_escape_string($jsonArray['hovbox']['content']);

                $sql = "INSERT INTO hovbox (hover_text, blue_box_text, image_url, content) 
                        VALUES ('$hover_text', '$blue_box_text', '$image_url', '$content')";
                $conn->query($sql);
            }

            // Insert white_box3 data
            if (isset($jsonArray['white_box3'])) {
                $header_text = $conn->real_escape_string($jsonArray['white_box3']['header_text']);

                $sql = "INSERT INTO white_box3 (header_text) VALUES ('$header_text')";
                $conn->query($sql);
                $box3_id = $conn->insert_id;

                foreach ($jsonArray['white_box3']['list_items'] as $item) {
                    $item = $conn->real_escape_string($item);
                    $sql = "INSERT INTO white_box3_list_items (white_box3_id, list_item) VALUES ($box3_id, '$item')";
                    $conn->query($sql);
                }

                foreach ($jsonArray['white_box3']['links'] as $link) {
                    $link_text = $conn->real_escape_string($link['text']);
                    $link_url = $conn->real_escape_string($link['url']);
                    $sql = "INSERT INTO white_box3_links (white_box3_id, text, url) VALUES ($box3_id, '$link_text', '$link_url')";
                    $conn->query($sql);
                }
            }

            // Insert box5 data
            if (isset($jsonArray['box5'])) {
                $header_text = $conn->real_escape_string($jsonArray['box5']['header_text']);
                $content = $conn->real_escape_string($jsonArray['box5']['content']);

                $sql = "INSERT INTO box5 (header_text, content) VALUES ('$header_text', '$content')";
                $conn->query($sql);
                $box5_id = $conn->insert_id;

                foreach ($jsonArray['box5']['links'] as $link) {
                    $link_text = $conn->real_escape_string($link['text']);
                    $link_url = $conn->real_escape_string($link['url']);
                    $sql = "INSERT INTO box5_links (box5_id, text, url) VALUES ($box5_id, '$link_text', '$link_url')";
                    $conn->query($sql);
                }
            }

            // Insert box7 data
            if (isset($jsonArray['box7'])) {
                $image_url = $conn->real_escape_string($jsonArray['box7']['image_url']);

                $sql = "INSERT INTO box7 (image_url) VALUES ('$image_url')";
                $conn->query($sql);
            }

            echo 'News JSON file uploaded, validated, and stored in the database successfully!';
           
            header('Location: hadelandheba.php');
            exit();

        } else {
            echo 'Error: JSON file does not contain the required news structure or is invalid.';
        }

    } else {
        echo 'Error: No file uploaded or upload error.';
    }

} else {
    echo 'Invalid request method.';
}

$conn->close();

// Validate JSON structure
function validateNewsJsonStructure($jsonArray) {

    if (isset($jsonArray['news']) && is_array($jsonArray['news'])) {
        foreach ($jsonArray['news'] as $newsItem) {
            if (!isset($newsItem['title']) || !isset($newsItem['imgurl']) || !isset($newsItem['content'])) {
                return false;
            }
        }
    } else {
        return false; 
    }

    if (isset($jsonArray['hovbox'])) {
        if (!isset($jsonArray['hovbox']['hover_text']) || 
            !isset($jsonArray['hovbox']['blue_box_text']) || 
            !isset($jsonArray['hovbox']['image_url']) || 
            !isset($jsonArray['hovbox']['content'])) {
            return false;
        }
    } else {
        return false; 
    }

    if (isset($jsonArray['white_box3'])) {
        if (!isset($jsonArray['white_box3']['header_text']) || 
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
    } else {
        return false; 
    }

    if (isset($jsonArray['box5'])) {
        if (!isset($jsonArray['box5']['header_text']) || 
            !isset($jsonArray['box5']['content']) || 
            !isset($jsonArray['box5']['links']) || 
            !is_array($jsonArray['box5']['links'])) {
            return false;
        }
        foreach ($jsonArray['box5']['links'] as $link) {
            if (!isset($link['url']) || !isset($link['text'])) {
                return false;
            }
        }
    } else {
        return false; 
    }

    if (isset($jsonArray['box7'])) {
        if (!isset($jsonArray['box7']['image_url'])) {
            return false;
        }
    } else {
        return false; 
    }

    return true; // If all checks pass
}


?>
