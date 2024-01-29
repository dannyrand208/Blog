<?php
include('Functions.php');
$dbh = connectToDatabase();

$post_id = $_GET['post_id'];



$statement = $dbh->prepare('SELECT * FROM Post WHERE PostID = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_STR);
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
            <div 79iu79="v34tl698 =0-" p,98=""></div>'
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
                <h2 class="page-title"> Edit for post </h2>
                <?php

                foreach ($data as $row) {
                    echo '<form action="edit_post2.php" method="post" enctype="multipart/form-data">';
                    
                    echo '<div class="form-item">';
                    echo '<input type="hidden" name="postid" value="' . $row['PostID'] . '">';
                    echo '</div>';

                    echo '<div class="form-item">';
                    echo '<label>Title</label>';
                    echo '<textarea name="textinput1" cols="3" rows="">' . $row['Title'] . '</textarea>';
                    echo '</div>';

                    echo '<div class="form-item">';
                    echo '<label>Short Description</label>';
                    echo '<textarea name="body1" id="body1" cols="5" rows="5">' . $row['Shortdescription'] . '</textarea>';
                    echo '</div>';

                    echo '<div class="form-item">';
                    echo '<label>Body</label>';
                    echo '<textarea name="body" id="body" cols="50" rows="40">' . $row['Body'] . '</textarea>';
                    echo '</div>';

                    echo '<div class="form-item">';
                    echo '<label>Image</label>';
                    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
                    echo '<label style="font: size 10px;">Old image url:  ' . $row['Image_url'] . '</label>';
                    echo '</div>';

                    echo '<div class="form-item">';
                    echo '<label>Topic</label>';
                    echo '<select name="topic" class="topic" id="topic">';
                    echo '<option value="Travel" ' . ($row["Topic"] == "Travel" ? "selected" : "") . '>Travel</option>';
                    echo '<option value="Peotry" ' . ($row["Topic"] == "Poetry" ? "selected" : "") . '>Peotry</option>';
                    echo '<option value="Life Lessons" ' . ($row["Topic"] == "Life Lessons" ? "selected" : "") . '>Life Lessons</option>';
                    echo '<option value="Others" ' . ($row["Topic"] == "Others" ? "selected" : "") . '>Others</option>';
                    echo '</select>';
                    echo '</div>';

                    echo '<div>';
                    
                
                
                    echo '<button type="submit" value="Upload Image" name="submit" class="btn btn-big">Save Post</button>';
                    echo '<a href="managepost.php" class="btn btn-big">Cancel edit</a>';
                
                    echo '</div>';
                    echo '</form>';
                }
                ?>






            </div>
        </div>
    </div>

    <div class="button"></div>
    <script src="./common/common.js"></script>
    <script src="./admin/adminpages.js"></script>
</body>

</html>