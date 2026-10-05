<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleAgain.css">
</head>
<body>
    <div class="container1">
        <img class="logo">
        <div class="container2">
            <div class="nav-bar">
                <!-- Navigation Links -->
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
                <a href="#">Link 4</a>
                <a href="#">Link 5</a>
                <a href="#">Link 6</a>
                <a href="#" style="border-right-style:none;">Link 7</a>

                <!-- Search box beside the links -->
                <div class="search-box">
                    <input type="search" class="search-input" placeholder="Search...">
                    <img src="media/share.png" alt="Search" class="search-image">
                </div>
            </div>

            <ul class="nav2">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <li><a href="#">Link 4</a></li>
                <li><a href="#">Link 5</a></li>
                <li><a href="#">Link 6</a></li>
                <li><a href="#">Link 7</a></li>
                <li><a href="#">Link 8</a></li>
                <li><a href="#">Link 9</a></li>
            </ul>
        </div>
    </div>

    <div class="container3">
        <div class="blue-box"></div>
        <div class="white-box">
            <span id="headline"></span>
        </div>
    </div>

    <div class="grid-container">
        <div>
            <div class="white-box3">
                <p style="border-bottom-style: solid;"></p>
                <ul class="list">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <div class="box3-footer">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>
        </div>

        <div class="hovbox">
            <div class="white-box2">
                <p id="hover-text"></p>
            </div>
            <div class="blue-box2">
                <p id="blue-box-text"></p>
            </div>
        </div>

        <div class="picbox"></div>
        <div class="pointbox">
            <div class="box5">
                <h1></h1>
                <p></p>
                <div class="box5-footer">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>
        </div>

        <div class="video-box">
            <video controls>
                <source src="myvideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="grid-item-large box7"></div>

        <div>
            <iframe src="https://hemsidelab.se/html-och-css/" width="100%" height="100%" style="border:none;"></iframe>
        </div>
    </div>

    
    <div class="admin">
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>
            <!-- If logged in, show link to the admin page -->
            <a href="admin.php" class="adminButton" id="admin-btn">Go To Admin Page</a>
        <?php else: ?>
            <!-- If not logged in, show login page link -->
            <a href="login.html" class="adminButton" id="admin-btn">Login to Admin</a>
        <?php endif; ?>
    </div>

    <script src="fetchdata.js"></script>

</body>
</html>
