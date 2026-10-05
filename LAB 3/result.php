<?php
require_once "dbcon.php";

// Get the 'id' parameter from the URL
$newsId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $newsId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the news item exists
if ($result->num_rows > 0) {
    $newsItem = $result->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($newsItem['title']); ?></title>
        <style>
            .news-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                font-family: Arial, sans-serif;
            }
            .news-title {
                font-size: 2em;
                margin-bottom: 10px;
            }
            .news-content {
                font-size: 1.1em;
            }
            .news-image {
                width: 100%;
                height: auto;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="news-container">
            <h1 class="news-title"><?php echo htmlspecialchars($newsItem['title']); ?></h1>
            <?php if (!empty($newsItem['imgurl'])): ?>
                <img src="<?php echo htmlspecialchars($newsItem['imgurl']); ?>" alt="News Image" class="news-image">
            <?php endif; ?>
            <div class="news-content">
                <?php echo nl2br(htmlspecialchars($newsItem['content'])); ?>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "News article not found.";
}

$stmt->close();
$conn->close();
?>
