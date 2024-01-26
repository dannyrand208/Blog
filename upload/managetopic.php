<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
$dbh = connectToDatabase();
$statement = $dbh->prepare("SELECT * FROM Topic");
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
    <link rel="stylesheet" href="managetopic2.css">
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
                <li> <a href="managepost.php">Manage Post</a></li>
                <li> <a href="manageuser.php">Manage Users</a></li>
                <li> <a href="managetopic.php">Manage Topics</a></li>
                <li> <a href="about.php">About</a></li>
            </ul>
        </div>


        <div class="admin-content">
            <div class="button-group">
                <a href="adminpages.php" class="btn btn-big">Add Topic</a>
                <a href="managetopic.php" class="btn btn-big">Manage Topic</a>
            </div>




            <div class="content">
                <h2 class="page-title"> Manage topic</h2>

                <?php
                echo "<p class='cookie' style='color:red'>$cookieMessage</p>";
                ?>
                <table>
                    <thead>
                        <th>Topic ID</th>
                        <th>Topic Name</th>
                        <th>User Created</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <?php

                    session_start();
                    echo '<p>Your role: '.$_SESSION['role'].'<p>';

                    foreach ($data as $row) {
                        if ($_SESSION['role'] === "User") {
                            if ($_SESSION['user_name'] === $row['username']) {

                                echo '<tbody>';
                                echo '<tr>';
                                echo '<td>' . $row['TopicID'] . '</td>';
                                echo '<td>' . $row['Topic'] . '</td>';
                                echo '<td>' . $row['username'] . '</td>';
                                echo '<td><a href="edit_topic.php?topic_id=' . $row['TopicID'] . '" class="edit">Edit</a></td>';
                                echo '<td><a href="deletetopic.php?topic_id=' . $row['TopicID'] . '" class="delete">Delete</a></td>';
                                echo '</tr>';
                                echo '</tbody>';
                            }
                        } else {
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td>' . $row['TopicID'] . '</td>';
                            echo '<td>' . $row['Topic'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td><a href="edit_topic.php?topic_id=' . $row['TopicID'] . '" class="edit">Edit</a></td>';
                            echo '<td><a href="deletetopic.php?topic_id=' . $row['TopicID'] . '" class="delete">Delete</a></td>';
                            echo '</tr>';
                            echo '</tbody>';

                        }
                    }
                    ?>
                </table>

            </div>
            </form>


        </div>


    </div>

    <div class="button">



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




    <div class="admin-content">
        <div class="button-group"></div>
    </div>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            console.log(subMenu);
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
    <script src="./common/common.js"></script>
    <script src="./admin/adminpages.js"></script>
   

</html>