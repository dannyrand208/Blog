<?php
include('Functions.php');

$dbh = connectToDatabase();
$statement = $dbh->prepare('SELECT * FROM Post');
$statement->execute();

$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

$search = $_GET['search'];

$sql = connectToDatabase();
$statement = $sql->prepare("SELECT * FROM Post WHERE Title LIKE '%$search%'");
$statement->execute();

$data1 = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data1[] = $row;

}
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog: Homepage</title>
    <link rel="stylesheet" href="blog1.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

</head>

<body>
    <p> erwqeweqweqwe</p>
    <nav class="navbar">
        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png"
                alt="ok">
        </a>
        <ul class="link-container">
            <li class="link-item"><a href="home.php" class="link">Home</a></li>
            <?php
            if (empty($cookieUser)) {
                // User is not logged in, display Sign Up and Sign In links.
                echo '<li class="link-item"><a href="/myprogram/upload/login.php" class="link">Login</a></li>';
            } else {
                // User is logged in, display Sign Out and user information.
                echo '<li class="link-item"><a href="adminpages.php" class="link">Admin</a></li>';
                echo '
                <img src="img/1.jpg" alt="" class="user-pic" onclick="toggleMenu()">
            <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info1">
                    <img src="img/1.jpg" alt="" clas="user-pic">
                    <h2>' . $cookieUser . '</h2>
                </div>
                <hr>


                <a href="#" class="sub-menu-link">
                <img src="img/profile.png" alt="">
                <p>Edit Profile</p>
                <span>></span>
            </a>
            <a href="#" class="sub-menu-link">
                <img src="img/setting.png" alt="">
                <p>Setting and Privacy</p>
                <span>></span>
            </a>
            <a href="#" class="sub-menu-link">
                <img src="img/help.png" alt="">
                <p>Help & Support</p>
                <span>></span>
            </a>
            <a href="logoutUser.php" class="sub-menu-link">
                <img src="img/logout.png" alt="">
                <p>Logout</p>
                <span>></span>
            </a>
            </div>
              
        </div>
      </div>';
            }
            ?>

            <form method="post" id="themeToggleBtn">
                <li class="link-item">

                    <img src="img/moon.png" class="icon" id="icon" type>

                </li>
            </form>
    </nav>
    <p>Search</p>


    <header class="header">
        <div class="content">
            <h1 class="heading">
                Do you know that human write and publish around 7.5 million blog on the internet per day
                <br><span class="no-fill">Want to wirte a blog?</span>
            </h1>
            <button class="btn1"> <a href="login.php" class="btn">Login to write a blog</a></button>
        </div>




    </header>

    <form action="blog.php" method="GET">
        <div class="search-bar" style="margin-top: 130px">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit" style="border:white;background-color:white;cursor:pointer;">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>


    <section class="blog-section">
        <?php

        if ($search == '') {
            foreach ($data as $row) {
                echo '<div class="blog-card">';
                echo '<img class="blog-image" src="img/' . $row['Image_url'] . '" alt="">';
                echo '<h1 class="blog-title">' . $row['Title'] . '</h1>';
                echo '<p class="blog-overview">' . $row['Shortdescription'] . '</p>';

                echo '<p class="post-date" id="postDate"><i class="far fa-calendar-alt"></i> ' . $row['currentTime'] . '</p>';

                echo '<a href="singleblog.php?post_id=' . $row["PostID"] . '" class="oke">Read more</a>';
                echo '</div>';
            }
        } else {
            if (count($data1) > 0) {
                foreach ($data1 as $row) {
                    echo '<div class="blog-card">';
                    echo '<img class="blog-image" src="img/' . $row['Image_url'] . '" alt="">';
                    echo '<h1 class="blog-title">' . $row['Title'] . '</h1>';
                    echo '<p class="blog-overview">' . $row['Shortdescription'] . '</p>';

                    echo '<p class="post-date" id="postDate"><i class="far fa-calendar-alt"></i> ' . $row['currentTime'] . '</p>';

                    echo '<a href="singleblog.php?post_id=' . $row["PostID"] . '" class="oke">Read more</a>';
                    echo '</div>';
                }
            } else {
                echo '<div class="announcement" style="display:flex;">';
                echo '<p class="postannouce" style="width:1100px;font-size 200px; color:var(--secondary-color);"> Sorry! There is no post matching with what you searched for! <p>';
                echo '<img style="width:700px; he object-cover:fit;" src="1.jpeg" alt="">';
                echo '</div>';
            }
        }
        ?>


    </section>


    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="about.php">about us and version</a></li>
                        <li><a href="">privacy policy</a></li>

                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Quick link</h4>
                    <ul>
                        <li><a href="home.php">home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="">FAQ</a></li>

                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Blog Topics</h4>
                    <ul>
                        <li><a href="">Peotry</a></li>
                        <li><a href="">Travel</a></li>
                        <li><a href="">Life Lessons</a></li>
                        <li><a href="">Others</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const themeToggleBtn = document.getElementById("themeToggleBtn");
            const icon = document.getElementById("icon");

            // Function to toggle theme and update local storage
            function toggleTheme() {
                const isDarkMode = document.body.classList.toggle("dark-theme");
                icon.src = isDarkMode ? "img/sun.png" : "img/moon.png";
                const newTheme = isDarkMode ? "dark" : "light";

                // Update theme in local storage
                localStorage.setItem("theme", newTheme);
            }

            // Check local storage for theme preference
            const storedTheme = localStorage.getItem("theme");
            if (storedTheme === "dark") {
                document.body.classList.add("dark-theme");
                icon.src = "img/sun.png";
            }

            // Add a click event listener to the button
            themeToggleBtn.addEventListener("click", toggleTheme);
        });
    </script>

<script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            console.log(subMenu);
            subMenu.classList.toggle("open-menu");
        }
    </script>

</body>

</html>