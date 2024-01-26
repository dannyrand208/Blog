<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();
$themeConfig = getCookieTheme();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog: Homepage</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


</head>

<body class="<?php if ($themeConfig == "dark")
    echo 'dark-theme'; ?>">
    <nav class="navbar">

        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png"
                alt="ok">
        </a>

        <ul class="link-container">
            <li class="link-item"><a href="home.php" class="link">Home</a>
            <li class="link-item"><a href="topic.php" class="link">Topic</a>
            <li class="link-item"><a href="blog.php" class="link">All Blog</a>

                <?php
                if (empty($cookieUser)) {

                    echo '<li class="link-item"><a href="/myprogram/upload/login.php" class="link">Login</a></li>';

                } else {
                    echo '<li class="link-item"><a href="managetopic.php" class="link">Admin</a></li>';
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
        </ul>



    </nav>

    <header class="header">
        <div class="content">
            <h1 class="heading">

                <?php

                if (empty($cookieUser)) {

                    echo '<span class="small">
            Welcome in the world of 
            </span>
            blog
            <span class="no-fill">writing</span>
            </h1>  
            <button class="btn1"> <a href="login.php" class="btn">Write a blog</a></button>
            </div>';

                } else {

                    echo "<span class='small'>
            Welcome Back
            </span>
            $cookieUser
            <span class='no-fill'></span>
            </h1>  
            <button class='btn1'> <a href='editor.php' class='btn'>Write a blog</a></button>
            </div>";
                }


                ?>
    </header>

    <section class="blog-section">
        <p style="text-align:center; font-size: 55px;"> Trending Post</p>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="blog-image" src="https://i.ytimg.com/vi/KE0hB9kXUVo/maxresdefault.jpg" alt="">
                    <h1 class="blog-title">AUSTRALIA TRAVEL BLOG | a week in Melbourne & Sydney! 🇦🇺</h1>
                    <p class="blog-overview">The first vlog in the Australia travel series! 🤩

                        For 7 weeks my boyfriend Sid and I will be travelling up the East Coast of Australia with
                        the help of travel agency My Adventure Project! Start building your customised trip with
                        them here: https://myadventureproject.com/ </p>
                    <a href="/" class="oke">Read more</a>
                </div>
                <div class="swiper-slide">
                    <img class="blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
                    <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
                    <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a
                        while, some of you may know I've been traveling around America! So I thought I'd update you
                        all on my trip so far and give you my initial thoughts and what we've been getting up too!
                        I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not)
                        and I wanted to share them with you!</p>
                    <a href="/" class="oke">Read more</a>
                </div>
                <div class="swiper-slide">
                    <img class="blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
                    <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
                    <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a
                        while, some of you may know I've been traveling around America! So I thought I'd update you
                        all on my trip so far and give you my initial thoughts and what we've been getting up too!
                        I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not)
                        and I wanted to share them with you!</p>
                    <a href="/" class="oke">Read more</a>
                </div>
                <div class="swiper-slide">
                    <img class="blog-image" src="https://i.ytimg.com/vi/KE0hB9kXUVo/maxresdefault.jpg" alt="">
                    <h1 class="blog-title">AUSTRALIA TRAVEL BLOG | a week in Melbourne & Sydney! 🇦🇺</h1>
                    <p class="blog-overview">The first vlog in the Australia travel series! 🤩

                        For 7 weeks my boyfriend Sid and I will be travelling up the East Coast of Australia with
                        the help of travel agency My Adventure Project! Start building your customised trip with
                        them here: https://myadventureproject.com/ </p>
                    <a href="/" class="oke">Read more</a>
                </div>
                <!-- <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div>
                <div class="swiper-slide">Slide 7</div>
                <div class="swiper-slide">Slide 8</div>
                <div class="swiper-slide">Slide 9</div> -->
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 3,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });

        </script>

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

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            console.log(subMenu);
            subMenu.classList.toggle("open-menu");
        }
    </script>


</body>

</html>