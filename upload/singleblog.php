<?php
// <--- do NOT put anything before this PHP tag
include('Functions.php');

$post_id = $_GET['post_id'];

$dbh = connectToDatabase();

$statement = $dbh->prepare('SELECT * FROM POST WHERE PostID = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
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
    <link rel="stylesheet" href="singleblog3.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

<body>
    <nav class="navbar">

        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png"
                alt="ok">
        </a>

        <ul class="link-container">
            <li class="link-item"><a href="home.php" class="link">Home</a>
            <li class="link-item"><a href="blog.php" class="link">Blog</a>

                <?php
                if (empty($cookieUser)) {

                    echo '<li class="link-item"><a href="/myprogram/upload/login.php" class="link">Login</a></li>';

                } else {
                    echo '<li class="link-item"><a href="managetopic.php" class="link">Admin</a></li>';
                    echo '<div class="dropdown" id="userDropdown">
            <a class="dropbtn">' . $cookieUser . ' &#9662;</a>
            <div class="dropdown-content" id="dropdownContent">
                <a href="logoutUser.php">Logout</a>
            </div>
          </div>';
                }

                ?>

                <form method="post" id="themeToggleBtn">
            <li class="link-item">

                <img src="img/moon.png" class="icon" id="icon" >


            </form>


        </ul>
    </nav>
    <section class="section">

        <?php
        foreach ($data as $row) {
            echo '<div class="banner">';
            echo '   <img src="img/' . $row['Image_url'] . '" alt="">';
            echo '</div>';
            echo '<div class="blog">';
            echo '    <h1 class="title">' . $row['Title'] . '</h1>';
            echo '<p class="published1" style="color:blue; font-weight:bold;"><span><i class="fas fa-user-alt" ></i>Author: ' . $row['username'] . '</span></p>';
            echo '<br>';
            echo '    <p class="published""><span><i class="far fa-calendar-alt"></i> ' . $row['currentTime'] . '</span></p>';
            echo '<br>';
            echo '      <div class="body">';
            echo '        ' . $row['Body'];
            echo '      </div>';
            echo '</div>';
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

            const storedTheme = localStorage.getItem("theme");
            if (storedTheme === "dark") {
                document.body.classList.add("dark-theme");
                icon.src = "img/sun.png";
            }

            // Check local storage for theme preference
         

            // Add a click event listener to the button
            themeToggleBtn.addEventListener("click", toggleTheme);
        });

    </script>


</body>

</html>