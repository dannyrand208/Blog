<?php // <--- do NOT put anything before this PHP tag
include('Functions.php');
$dbh = connectToDatabase();


$statement = $dbh->prepare('SELECT * FROM User');
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

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="adminpages1.css">
</head>

<body>
    <div class="navbar">

        <a class="logo" href="manageuser.php">
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
                echo '<li class="link-item">
                <a class="dropbtn">' . $cookieUser . '&#9662;</a>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="logoutUser.php">Logout</a>
                </div>
              </li>';
            }
            ?>
        </ul>

    </div>

    <div class=admin-wrapper>

        <div class="sidebar">
            <!-- Left Sidebar -->
            <header> Manage </header>
            <ul>
                <li> <a href="managepost.php">Manage Post</a></li>
                <li> <a href="manageuser.php">Manage Users</a></li>
                <li> <a href="managetopic.php">Manage Topics</a></li>
                <li> <a href="about.php">About</a></li>
            </ul>
        </div>


        <div class="admin-content">
            <div class="button-group">
                <a href="adduser.php" class="btn btn-big">Add Users</a>
                <a href="manageuser.php" class="btn btn-big">Manage Users</a>
            </div>

            <div class="content">

                <h2 class="page-title"> Manage User</h2>

                <?php
                echo "<p class='cookie' style='color:red'>$cookieMessage</p>";
                ?>
                <table>
                    <thead>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email </th>
                        <th>Role</th>
                        <th colspan='2'>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        session_start();
                        echo '<p>Your role: '.$_SESSION['role'].'<p>';
                        foreach ($data as $row) {
                            if ($_SESSION['role'] === "Admin") {
                                if ($_SESSION['user_name'] === $row['username']) {

                                    echo "<tr>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['password'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['Role'] . "</td>";
                                    echo "<td><a class='edit' href='edit_user.php?user_id=" . $row['UserID'] . "'>Edit</a></td>";
                                    echo "<td><a class='edit' style='color:blue;''>User In Use</a></td>";
                                } else {
                                    echo "<tr>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['password'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['Role'] . "</td>";
                                    echo "<td><a class='edit' href='edit_user.php?user_id=" . $row['UserID'] . "'>Edit</a></td>";
                                    echo "<td><a class='delete' href='deleteuser.php?user_id=" . $row['UserID'] . "'>Delete</a></td>";
                                    echo "</tr>";
                                }

                            } else {
                              


                            }

                        }


                        ?>
                    </tbody>
                </table>


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
            <script src="./common/common.js"></script>
            <script src="./admin/adminpages.js"></script>
</body>

</html>