<?php
// <--- do NOT put anything before this PHP tag
include('Functions.php');
include('backend/backend.php');
session_start();
$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser();

$post_id = $_GET['post_id'];

$_SESSION['post_id'] = $post_id;


//  DISPLAY POST 
$dbh = connectToDatabase();

$statement = $dbh->prepare('SELECT * FROM POST WHERE PostID = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}


//METHOD POST COMMENT

$currentTimestamp = time(); // Get the current timestamp
$currentFormattedTime = date('Y-m-d H:i:s', $currentTimestamp); // Format the timestamp as desired



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $post_id = $_POST['post'];
    $username = $_POST['user'];
    $content = $_POST['newComment'];
    $currentFormattedTime = date('Y-m-d H:i:s', $currentTimestamp);

    $statement = $dbh->prepare('INSERT INTO `Comment`(`PostID`, `User_comment`, `Content`,`Time_comment`) VALUES (:postid1, :usercomment, :content,:time_comment)');
    $statement->bindParam(':postid1', $post_id, PDO::PARAM_STR);
    $statement->bindParam(':usercomment', $username, PDO::PARAM_STR);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':time_comment', $currentFormattedTime, PDO::PARAM_STR);
    $statement->execute();


}

//DISPLAY COMMENT

$servername = "localhost";
$username = "root";
$password = "";


$conn = new PDO("mysql:host=$servername;dbname=forum", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$statement = $conn->prepare('SELECT * FROM Comment WHERE PostID = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();


$data1 = array();
while ($row1 = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data1[] = $row1;
}


//GET LIKE COUNT DATABASE
$post_id = $_GET['post_id'];
$username = $cookieUser;
$query = "SELECT COUNT(*) AS likes FROM Likes WHERE PostID = ? AND rating_action = 'like'";
$stmt = $dbh->prepare($query);
$stmt->bindValue(1, $post_id);
$stmt->execute();
$like_count = $stmt->fetch(PDO::FETCH_ASSOC)['likes'];




//GET DISLIKE COUNT DATABSE

$query1 = "SELECT COUNT(*) AS dislikes FROM Likes WHERE PostID = ? AND rating_action = 'dislike'";
$stmt1 = $dbh->prepare($query1);
$stmt1->bindValue(1, $post_id);
$stmt1->execute();
$dislike_count = $stmt1->fetch(PDO::FETCH_ASSOC)['dislikes'];


//GET ACTION DATABSE

$query2 = "SELECT rating_action FROM Likes WHERE PostID = ? AND username = ?";
$stmt2 = $dbh->prepare($query2);
$stmt2->bindValue(1, $post_id);
$stmt2->bindValue(2, $cookieUser);
$stmt2->execute();
$status = $stmt2->fetch(PDO::FETCH_ASSOC)['rating_action'];




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
    <script src="backend/backend.js"></script>
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




                </div>
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

                <img src="img/moon.png" class="icon" id="icon">


                </form>



        </ul>
    </nav>
    <section class="section">

        <?php
        foreach ($data as $row) {
            var_dump($status);
            echo '<div class="banner">';
            echo '<img src="img/' . $row['Image_url'] . '" alt="">';
            echo '</div>';
            echo '<div class="blog">';
            echo '<h1 class="title">' . $row['Title'] . '</h1>';
            echo '<p class="published1" style="color: blue; font-weight: bold;"><span><i class="fas fa-user-alt"></i>Author: ' . $row['username'] . '</span></p>';
            echo '<div class="like-section">';
            echo '<input type="hidden" name="post_id" value="' . $row['PostID'] . '">';

            $data_post_id = $post_id;

            if ($status === 'like') {
                $selectedClass = 'selected';
            } else if ($status === 'dislike') {
                $selectedClass1 = 'selected';
            }

            echo '<button style="font-size: 24px" class="like-btn like ' . $selectedClass . '"  class="" data-post-id ="' . $data_post_id . '" ><i class="fa fa-thumbs-up"></i></button>';
            echo '<span class="likes_count ' . $post_id . '" data-count ="' . $like_count . '" >' . $like_count . ' likes  </span>';







            echo '<input type="hidden" name="post_id" value="' . $row['PostID'] . '">';





            echo '<button style="font-size: 24px" class="like-btn dislike ' . $selectedClass1 . '" data-post-id ="' . $data_post_id . '" ><i class="fa fa-thumbs-down"></i></button>';
            echo '<span class="dislikes_count ' . $post_id . '" data-count ="' . $dislike_count . '" >' . $dislike_count . '  likes </span>';
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
    <?php
    echo '<div class="comment-container">
        <h2>Comment</h2><br>';




    foreach ($data1 as $row1) {

        //GET LIKE COUNT COMMENT DATABSE
        $query = "SELECT COUNT(*) AS likes FROM Like_comment WHERE CommentID= ? AND PostId = ? AND User_comment = ? AND User_like =? AND rating_action = 'like'";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(1, $row1['CommentID']);
        $stmt->bindValue(2, $data_post_id);
        $stmt->bindValue(3, $row1['User_comment']);
        $stmt->bindValue(4, $cookieUser);
        $stmt->execute();
        $like_count_comment = $stmt->fetch(PDO::FETCH_ASSOC)['likes'];


        //GET LIKE DISCOUNT COMMENT DATABSE
        $query = "SELECT COUNT(*) AS dislikes 
        FROM `Like_comment` 
        WHERE `CommentID` = ? AND `PostId` = ? AND `User_comment` = ? AND `User_like` = ? AND `rating_action` = 'dislike';";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(1, $row1['CommentID']);
        $stmt->bindValue(2, $data_post_id);
        $stmt->bindValue(3, $row1['User_comment']);
        $stmt->bindValue(4, $cookieUser);
        $stmt->execute();
        $dislike_count_comment = $stmt->fetch(PDO::FETCH_ASSOC)['dislikes'];



        //GET STATUS
        $query = "SELECT rating_action 
        FROM `Like_comment` 
        WHERE `CommentID` = ? AND `PostId` = ? AND `User_comment` = ? AND `User_like` = ?;";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(1, $row1['CommentID']);
        $stmt->bindValue(2, $data_post_id);
        $stmt->bindValue(3, $row1['User_comment']);
        $stmt->bindValue(4, $cookieUser);
        $stmt->execute();
        $status1 = $stmt->fetch(PDO::FETCH_ASSOC)['rating_action'];
        $selected1= ' ';
        $selected2=' ';
        if ($status1 === 'like') {
            $selected1 = 'selected';
        } else if ($status1 === 'dislike') {
            $selected2 = 'selected';
        }

        echo '<div class="comment">
    <div class="comment-header">
        <div class="user-info">
            <div class="ava">
                <img src="img/360_F_514184651_W5rVCabKKRH6H3mVb62jYWfuXio8c8si.jpg" alt="Avatar" class="avatar">
                <div class="user-details">
                    <p class="username">' . $row1['User_comment'] . '</p>
                    <p class="timestamp">' . $row1['Time_comment'] . '</p>
        
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
    <p class="comment-text">' . $row1['Content'] . '</p>

    <div class="like-section">

        <button type="submit" style="font-size:18px" class="like-btn likes ' . $selected1 . '" 
        data-post-id ="' . $data_post_id . '" 
        data-comment-id ="' . $row1['CommentID'] . '"
        data-user-comment ="' . $row1['User_comment'] . '" 
        
    
    
        ><i class="fa fa-thumbs-up"></i></button>
        <span class="likecount ' . $row1['CommentID'] . '"  style="font-size:15px" data-count= ' . $like_count_comment . ' >  ' . $like_count_comment . ' likes</span>
        


        <button type = "submit" style="font-size:18px" class="like-btn dislikes ' . $selected2 . '" 
        data-post-id ="' . $data_post_id . '" 
        data-comment-id ="' . $row1['CommentID'] . '" 
        data-user-comment="' . $row1['User_comment'] . '" 
      
        
        
        ><i class="fa fa-thumbs-down"></i></button>
        <span class="dislikecount ' . $row1['CommentID'] . '"  style="font-size:15px" data-count = ' . $dislike_count_comment . ' >' . $dislike_count_comment . ' likes</span>
        

    </div>
</div>';
    }


    echo '<form  method="post">
<div class="comment-form">
    <div class="user-info">
        <div class="ava">
            <img src="img/frog.jpeg" alt="Your Avatar" class="avatar">
            <div class="user-details">
                <p class="username">' . $cookieUser . '</p>
            </div>
        </div>
    </div>
    <textarea name="newComment" id="newComment" placeholder="Write your comment here"></textarea>
    <input type="hidden"  name="post" value="' . $row1['User_comment'] . '">
    <input type="hidden" name="user" value="' . $cookieUser . '">
    <div class="post">
        <button type="submit">Post</button>
    </div>
</div>
</form>
</div>';

    ?>



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

            var initialLikeCount = <?php echo $like_count; ?>;
            var likeCountElement = document.querySelector('.likes_count');
            likeCountElement.textContent = initialLikeCount + ' likes';
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
        $('.like, .dislike').click(function (e) {
            var status = $(this).hasClass('like') ? 'like' : 'dislike';
            console.log(status);
            var data = {
                post_id: <?php echo $post_id; ?>,
                user_name: '<?php echo $cookieUser; ?>',
                status: status
            };

            var $button = $(this);
            $.ajax({
                url: 'update_like.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    // Handle success response here
                    response = JSON.parse(response);
                    var action = response.action;
                    if (action === 'insert') {
                        if (status == 'like') {
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like + 1);
                            $('.likes_count').text(`${cnt_like + 1} likes`);

                            var likebutton = $('.like');
                            likebutton.addClass('selected');
                        } else if (status == 'dislike') {
                            var cnt_dislike = $('.dislikes_count').data('count');;
                            $('.dislikes_count').data('count', cnt_dislike + 1);
                            $('.dislikes_count').text(`${cnt_dislike + 1} likes`);

                            var dislikebutton = $('.dislike');
                            dislikebutton.addClass('selected');
                        }

                    } else if (action == 'back_to_normal') {
                        if (status == 'like') {
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like - 1);
                            $('.likes_count').text(`${cnt_like - 1} likes`);

                            var likebutton = $('.like');
                            likebutton.removeClass('selected');

                        } else if (status == 'dislike') {
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike - 1);
                            $('.dislikes_count').text(`${cnt_dislike - 1} likes`);

                            var dislikebutton = $('.dislike');
                            dislikebutton.removeClass('selected');

                        }
                    } else if (action == 'update') {
                        if (status == 'like') {
                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like + 1);
                            $('.likes_count').text(`${cnt_like + 1} likes`);
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike - 1);
                            $('.dislikes_count').text(`${cnt_dislike - 1} likes`);

                            var likebutton = $('.like');
                            var dislikebutton = $('.dislike');
                            dislikebutton.removeClass('selected');
                            likebutton.addClass('selected');


                        } else if (status == 'dislike') {

                            var cnt_like = $('.likes_count').data('count');
                            $('.likes_count').data('count', cnt_like - 1);
                            $('.likes_count').text(`${cnt_like - 1} likes`);
                            var cnt_dislike = $('.dislikes_count').data('count');
                            $('.dislikes_count').data('count', cnt_dislike + 1);
                            $('.dislikes_count').text(`${cnt_dislike + 1} likes`);

                            var likebutton = $('.like');


                            var dislikebutton = $('.dislike');
                            likebutton.removeClass('selected');
                            dislikebutton.addClass('selected');

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

    <script type="text/javascript">
        $('.likes, .dislikes').click(function (e) {
            var status1 = $(this).hasClass('likes') ? 'like' : 'dislike';
            var commentid = $(this).data('comment-id');
            var user_comment = $(this).data('user-comment');
            var data = {
                post_id1: <?php echo $post_id; ?>,
                user_comment: `${user_comment}`,
                status1: status1,
                commentid: commentid,
                user_like: '<?php echo $cookieUser; ?>'
            };
            var $button = $(this);
            $.ajax({
                url: 'update_like_comment.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    response = JSON.parse(response);
                    var action = response.action;

                    console.log(action);

                    if (action === 'insert') {
                        if (status1 == 'like') {
                            var cnt_like = $button.closest('.like-section').find('.likecount').data('count');
                            $button.closest('.like-section').find('.likecount').data('count', cnt_like + 1);
                            $button.closest('.like-section').find('.likecount').text(`${cnt_like + 1} likes`);


                            var likebutton = $button;
                            likebutton.addClass('selected');
                        } else if (status1 == 'dislike') {
                            var cnt_dislike = $button.closest('.like-section').find('.dislikecount').data('count');
                            $button.closest('.like-section').find('.dislikecount').data('count', cnt_dislike + 1);
                            $button.closest('.like-section').find('.dislikecount').text(`${cnt_dislike + 1} likes`);



                            var dislikebutton = $button;
                            dislikebutton.addClass('selected');
                        }

                    } else if (action == 'back_to_normal') {
                        if (status1 == 'like') {
                            var cnt_like = $button.closest('.like-section').find('.likecount').data('count');
                            $button.closest('.like-section').find('.likecount').data('count', cnt_like - 1);
                            $button.closest('.like-section').find('.likecount').text(`${cnt_like - 1} likes`);


                            var likebutton = $button;
                            likebutton.removeClass('selected');

                        } else if (status1 == 'dislike') {
                            var cnt_dislike = $button.closest('.like-section').find('.dislikecount').data('count');
                            $button.closest('.like-section').find('.dislikecount').data('count', cnt_dislike - 1);
                            $button.closest('.like-section').find('.dislikecount').text(`${cnt_dislike - 1} likes`);


                            var dislikebutton = $button;
                            dislikebutton.removeClass('selected');

                        }
                    } else if (action == 'update') {
                        if (status1 == 'like') {
                            var cnt_like = $button.closest('.like-section').find('.likecount').data('count');
                            $button.closest('.like-section').find('.likecount').data('count', cnt_like + 1);
                            $button.closest('.like-section').find('.likecount').text(`${cnt_like + 1} likes`);
                            var cnt_dislike = $button.closest('.like-section').find('.dislikecount').data('count');
                            $button.closest('.like-section').find('.dislikecount').data('count', cnt_dislike - 1);
                            $button.closest('.like-section').find('.dislikecount').text(`${cnt_dislike - 1} likes`);


                            var likebutton = $button.closest('.like-section').find('.likes');
                            var dislikebutton = $button.closest('.like-section').find('.dislikes');
                            dislikebutton.removeClass('selected');
                            likebutton.addClass('selected');


                        } else if (status1 == 'dislike') {

                            var cnt_like = $button.closest('.like-section').find('.likecount').data('count');
                            $button.closest('.like-section').find('.likecount').data('count', cnt_like - 1);
                            $button.closest('.like-section').find('.likecount').text(`${cnt_like - 1} likes`);
                            var cnt_dislike = $button.closest('.like-section').find('.dislikecount').data('count');
                            $button.closest('.like-section').find('.dislikecount').data('count', cnt_dislike + 1);
                            $button.closest('.like-section').find('.dislikecount').text(`${cnt_dislike + 1} likes`);

                            var likebutton = $button.closest('.like-section').find('.likes');
                            var dislikebutton = $button.closest('.like-section').find('.dislikes');
                            likebutton.removeClass('selected');
                            dislikebutton.addClass('selected');

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


    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            console.log(subMenu);
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>

</html>