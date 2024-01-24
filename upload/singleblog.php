<?php
// <--- do NOT put anything before this PHP tag
include('Functions.php');
session_start();
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();

$post_id = $_GET['post_id'];

$_SESSION['post_id'] = $post_id;



$dbh = connectToDatabase();

$statement = $dbh->prepare('SELECT * FROM POST WHERE PostID = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();



$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}
$post_id = $_GET['post_id'];
$username = $cookieUser;
$query = "SELECT COUNT(*) AS likes FROM Likes WHERE PostID = ? AND rating_action = 'like'";
$stmt = $dbh->prepare($query);
$stmt->bindValue(1, $post_id); //Assuming post_id is an integer, a djust the type accordingly
$stmt->execute();
$like_count = $stmt->fetch(PDO::FETCH_ASSOC)['likes'];


$query1 = "SELECT COUNT(*) AS dislikes FROM Likes WHERE PostID = ? AND rating_action = 'dislike'";
$stmt1 = $dbh->prepare($query1);
$stmt1->bindValue(1, $post_id); //Assuming post_id is an integer, a djust the type accordingly
$stmt1->execute();
$dislike_count = $stmt1->fetch(PDO::FETCH_ASSOC)['dislikes'];



$query2 = "SELECT rating_action FROM Likes WHERE PostID = ? AND username = ?";
$stmt2 = $dbh->prepare($query2);
$stmt2->bindValue(1, $post_id);
$stmt2->bindValue(2, $cookieUser);
$stmt2->execute();
$row = $stmt2->fetch(PDO::FETCH_ASSOC);



if ($row) {
    $status = $row['rating_action'];
} else {
    $status = 0;
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog: Homepage</title>
    <link rel="stylesheet" href="singleblog.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

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

                <img src="img/moon.png" class="icon" id="icon">


                </form>


        </ul>
    </nav>
    <section class="section">

        <?php
        foreach ($data as $row) {
            echo '<div class="banner">';
            echo '<img src="img/' . $row['Image_url'] . '" alt="">';
            echo '</div>';
            echo '<div class="blog">';
            echo '<h1 class="title">' . $row['Title'] . '</h1>';
            echo '<p class="published1" style="color: blue; font-weight: bold;"><span><i class="fas fa-user-alt"></i>Author: ' . $row['username'] . '</span></p>';
            echo '<div class="like-section">';
            echo '<input type="hidden" name="post_id" value="' . $row['PostID'] . '">';

            // Assuming $status is already defined and contains the like status
        
            // Use a ternary operator to conditionally add the 'selected' class
            $selectedClass = ($status == 'like') ? 'selected' : '';
            $data_post_id = $post_id;


            echo '<button style="font-size: 24px" class="like-btn like ' . $selectedClass . '" data-post-id ="' . $data_post_id . '" ><i class="fa fa-thumbs-up"></i></button>';
            echo '<span class="likes_count ' . $post_id . '" data-count ="' . $like_count . '" >' . $like_count . '</span>';






            echo '<input type="hidden" name="post_id" value="' . $row['PostID'] . '">';

            $selectedClass = ($status == 'dislike') ? 'selected' : '';
            $data_post_id = $post_id;


            echo '<button style="font-size: 24px" class="like-btn dislike ' . $selectedClass . '" data-post-id ="' . $data_post_id . '" ><i class="fa fa-thumbs-down"></i></button>';
            echo '<span class="dislikes_count ' . $post_id . '" data-count ="' . $dislike_count . '" >' . $dislike_count . '</span>';
            echo '</div>';





            echo '<br>';
            echo '    <p class="published""><span><i class="far fa-calendar-alt"></i> ' . $row['currentTime'] . '</span></p>';
            echo '<br>';
            echo '      <div class="body">';
            echo '        ' . $row['Body'];
            echo '      </div>';
            echo '</div>';
        }
        ?>

        <br> <br> <br> <br>


    </section>
    <div class="comment-container">
        <h2>Comment</h2>
        <br>

        <div class="comment">
            <div class="comment-header">
                <div class="user-info">
                    <div class="ava">
                        <img src="img/181210-roger-buff-kangaroo-mn-0840.jpg" alt="Avatar" class="avatar">
                        <div class="user-details">
                            <p class="username">Lam Thon</p>
                            <p class="timestamp">2 hours ago</p>
                        </div>

                    </div>

                    <button style="margin-left:400px;" class="options-btn" onclick="toggleOptions()">...</button>
                </div>
                <div class="options">

                    <div class="options-menu">
                        <button class="edit-btn" onclick="editComment()">Edit</button>
                    </div>
                </div>
            </div>
            <p class="comment-text">Cai post nay trong ngu vcl nma thoi vay

            </p>
            <div class="like-section">
                <button style="font-size:24px" class="like-btn" onclick="toggleLike(this)"><i
                        class="fa fa-thumbs-up"></i></button>
                <span class="like-count">0 likes</span>



                <button style="font-size:24px" class="like-btn" onclick="toggleLike(this)"><i
                        class="fa fa-thumbs-down"></i></button>
                <span class="like-count">0 likes</span>

            </div>
        </div>



        <div class="comment">
            <div class="comment-header">
                <div class="user-info">
                    <div class="ava">
                        <img src="img/181210-roger-buff-kangaroo-mn-0840.jpg" alt="Avatar" class="avatar">
                        <div class="user-details">
                            <p class="username">Dep trai Thon</p>
                            <p class="timestamp">2 hours ago</p>
                        </div>

                    </div>

                    <button style="margin-left:400px;" class="options-btn" onclick="toggleOptions()">...</button>
                </div>
                <div class="options">

                    <div class="options-menu">
                        <button class="edit-btn" onclick="editComment()">Edit</button>
                    </div>
                </div>
            </div>
            <p class="comment-text">Cai post nay trong ngu vcl nma thoi vay

            </p>
            <div class="like-section">
                <button style="font-size:24px" class="like-btn" onclick="toggleLike(this)"><i
                        class="fa fa-thumbs-up"></i></button>
                <span class="like-count">0 likes</span>



                <button style="font-size:24px" class="like-btn" onclick="toggleLike(this)"><i
                        class="fa fa-thumbs-down"></i></button>
                <span class="like-count">0 likes</span>

            </div>
        </div>


        <div class="comment-form">
            <div class="user-info">
                <div class="ava">
                    <img src="img/frog.jpeg" alt="Your Avatar" class="avatar">

                    <div class="user-details">
                        <p class="username">Your Username</p>

                    </div>
                </div>
            </div>
            <textarea name="newComment" id="newComment" placeholder="Write your comment here" required></textarea>
            <div class="post">
                <button type="submit" onclick="submitComment(event)">Post</button>
            </div>
        </div>
    </div>


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

    <script type="text/javascript">
        $('.like, .dislike').click(function () {
            var status = $(this).hasClass('like') ? 'like' : 'dislike';
            var data = {
                post_id: <?php echo $post_id; ?>,
                user_name: '<?php echo $cookieUser; ?>',
                status: status
            };

            $.ajax({
                url: 'update_like.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    // Handle success response here
                    console.log(response);
                    response  = JSON.parse(response);
                    var action = response.action;
                    if (action === 'insert') {
                        if (status == 'like') {
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like + 1);
                            $('.likes_count').text(cnt_like + 1);
                        } else if (status == 'dislike') {
                            var cnt_dislike = $('.dislikes_count').data('count');;
                            $('.dislikes_count').data('count', cnt_dislike + 1);
                            $('.dislikes_count').text(cnt_dislike + 1);
                        }
                        
                    } else if (action == 'back_to_normal') {
                        if(status =='like'){
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like - 1);
                            $('.likes_count').text(cnt_like - 1);
                        }else if(status =='dislike') {
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike - 1);
                            $('.dislikes_count').text(cnt_dislike - 1);
                        }
                    } else if (action == 'update'){
                        if(status =='like'){
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like + 1);
                            $('.likes_count').text(cnt_like + 1);
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike - 1);
                            $('.dislikes_count').text(cnt_dislike - 1);

                        } else if (status =='dislike') {
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like - 1);
                            $('.likes_count').text(cnt_like - 1);
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike + 1);
                            $('.dislikes_count').text(cnt_dislike + 1);

                           

                        }
            
                    } else {
                        console.log('hello4');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error here
                    console.error(xhr.responseText);
                }
            });
        });

    </script>

</body>

</html>