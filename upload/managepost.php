<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');

$dbh = connectToDatabase();
$statement = $dbh->prepare('SELECT * FROM Post');
$statement->execute();




$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}


$cookieMessage = getCookieMessage();
$cookieUser = getCookieUser()


    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog: Homepage</title>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="adminpages.css">
</head>

<body>
    <div class="navbar">

        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png"
                alt="ok">
        </a>

        <ul class="link-container">
            <li class="link-item"><a href="home.php" class="link">Home</a></li>

            <div id="user_info">


            </div>
            <?php
            if (empty($cookieUser)) {


                echo '<li class="link-item"><a href="/myprogram/upload/login.php" class="link">Login</a></li>';
            } else {
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
        </ul>

    </div>

    <div class=admin-wrapper>

        <div class="sidebar">
            <!-- Left Sidebar -->
            <header>Manage </header>
            <ul>
            <li> <a href="editprofile.php">Edit Profile</a></li>
                <li> <a href="managepost.php">Manage Post</a></li>
                <li> <a href="manageuser.php">Manage Users</a></li>
                <li> <a href="managetopic.php">Manage Topics</a></li>
                <li> <a href="about.php">About</a></li>
            </ul>
        </div>


        <div class="admin-content">
            <div class="button-group">
                <a href="addpost.php" class="btn btn-big">Add Post</a>
                <a href="managepost.php" class="btn btn-big">Manage Post</a>
            </div>

            <div class="content">
                <h2 class="page-title"> Manage Post</h2>
                <?php
                echo "<p class='cookie' style='color:red'>$cookieMessage</p>";
                ?>
                <table>
                    <thead>
                        <th>PostID</th>
                        <th>Title</th>
                        <th>Author(Username)</th>
                        <th>Topic Type</th>
                        <th colspan='3'>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        echo '<p>Your role: ' . $_SESSION['role'] . '<p>';


                        foreach ($data as $row) {
                            if ($_SESSION['role'] === "User") {

                                if ($_SESSION['user_name'] === $row['username']) {

                                    echo "<tr>";
                                    echo "<td>" . $row['PostID'] . "</td>";
                                    echo "<td>" . $row['Title'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['Topic'] . "</td>";
                                    echo "<td><a class='edit' href='edit_post.php?post_id=" . $row['PostID'] . "'>Edit</a></td>";
                                    echo "<td><a class='delete' href='deletepost.php?post_id=" . $row['PostID'] . "'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td>" . $row['PostID'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['Topic'] . "</td>";
                                echo "<td><a class='edit' href='edit_post.php?post_id=" . $row['PostID'] . "'>Edit</a></td>";
                                echo "<td><a class='delete' href='deletepost.php?post_id=" . $row['PostID'] . "'>Delete</a></td>";
                                echo "</tr>";

                            }
                        }


                        ?>
                    </tbody>
                </table>
            </div>

            <script src="./common/common.js"></script>
            <script src="./admin/adminpages.js"></script>
            <!-- <script>
        // JavaScript for handling the asynchronous form submission
        function addTopic() {
            var topicName = document.getElementById('topicName').value;
            var topicDescription = document.getElementById('topicDescription').value;

            // You can perform additional validation here

            // Using AJAX to send the form data to the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_topic.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server, if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.send('topicName=' + encodeURIComponent(topicName) + '&topicDescription=' + encodeURIComponent(topicDescription));
        }
    </script>
 -->




        
            <script src="./common/common.js"></script>
            <script src="./admin/adminpages.js"></script>
            <script>
                let subMenu = document.getElementById("subMenu");

                function toggleMenu() {
                    console.log(subMenu);
                    subMenu.classList.toggle("open-menu");
                }
            </script>
</body>

</html>