<?php
include('Functions.php');
$dbh = connectToDatabase();

$user_id = $_GET['user_id'];



$statement = $dbh->prepare('SELECT * FROM User WHERE UserID = :user_id');
$statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$statement->execute();
$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to update the topic
    $User_id = $_POST['user_id'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $newPassword2 = $_POST['password2'];
    $newEmail = $_POST['email'];
    $newRole = $_POST['role'];

    updateUser($User_id, $newUsername, $newEmail, $newPassword, $newPassword2, $newRole);

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
                <a href="adduser.php" class="btn btn-big">Add Users</a>
                <a href="manageuser.php" class="btn btn-big">Manage Users</a>
            </div>

            <div class="content">
                <h2 class="page-title"> Manage Users</h2>
                <table>
                    <thead>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Password Again</th>
                        <th>Email </th>
                        <th>Role</th>
                        <th colspan='2'>Action</th>
                    </thead>
                    <?php
                    echo '<tbody >';
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<form method='post' action='edit_user.php'>";
                        echo "<input type='hidden' name='user_id' value='" . $row['UserID'] . "'>";
                        echo "<input type='hidden' name='password2' value='" . $row['password2'] . "'>";
                        echo "<td><textarea name='username'style='font-size:20px;'>" . $row['username'] . "</textarea></td>";
                        echo "<td><textarea name='password'style='font-size:20px;'>" . $row['password'] . "</textarea></td>";
                        echo "<td><textarea name='password2'style='font-size:20px;'>" . $row['password2'] . "</textarea></td>";
                        echo "<td><textarea name='email'style='font-size:20px;'>" . $row['email'] . "</textarea></td>";
                        echo "<td><select name='role' style='font-size:20px;'>";
                        echo "<option value='Admin' " . ($row['Role'] == 'Admin' ? 'selected' : '') . ">Admin</option>";
                        echo "<option value='User' " . ($row['Role'] == 'User' ? 'selected' : '') . ">User</option>";
                        echo "</select></td>";
                        echo "<td><button type='submit' class='edit' name='edit' style='background: none;
                        border: none; cursor:pointer; color:green; font-size:20px;'>Save</button></td>";
                        echo "</form>";
                        echo "<td><a class='delete' href='manageuser.php'>Cancel</a></td>";
                        echo "</tr>";
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