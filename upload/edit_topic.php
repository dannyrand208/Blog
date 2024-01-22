<?php
include('Functions.php');
$dbh = connectToDatabase();

$topic_id = $_GET['topic_id'];
$statement = $dbh->prepare('SELECT * FROM Topic WHERE TopicID = :topic_id');
$statement->bindParam(':topic_id', $topic_id, PDO::PARAM_STR);
$statement->execute();
$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to update the topic
    $topicId = $_POST['topicId'];
    $newTopicName = $_POST['topicName'];

    // Validate and update the topic details
    updateTopic($topicId, $newTopicName); // Implement this function to update the topic details
    setCookieMessage('The topic has been successfully updated');
    // Redirect back to the manage topic page after updating
    redirect('managetopic.php');
    exit;
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
    <link rel="stylesheet" href="managetopic.css">
</head>

<body>
    <div class="navbar">

        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png" alt="ok">
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
                <table>
                    <thead>
                        <th>Topic ID</th>
                        <th>Topic Name</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <?php
                    echo '<tbody>';
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo '<form method="post" action="edit_topic.php">';
                        echo '<td>' . $row['TopicID'] . '</td>';
                        echo '<td><textarea name="topicName" style="font-size:20px">' . $row['Topic'] . '</textarea></td>';
                        echo '<input type="hidden" name="topicId" value="' . $row['TopicID'] . '">';
                        echo '<td><button type="submit" class="edit1" style="background: none;
                        border: none; cursor:pointer; color:green; font-size:20px;" name="edit">Save</button></td>';
                        echo '</form>';
                        echo "<td><a class='delete' href='managetopic.php'>Cancel</a></td>";
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    ?>
                </table>

            </div>
        </div>
    </div>

    <div class="button"></div>
    <script src="./common/common.js"></script>
    <script src="./admin/adminpages.js"></script>
</body>

</html>
