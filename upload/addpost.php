
<?php // <--- do NOT put anything before this PHP tag
	include('Functions.php');
	
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
    <link rel="stylesheet" href="adminpages1.css">
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
        <ul >
            <li> <a  href="managepost.php">Manage Post</a></li>
            <li> <a  href="manageuser.php">Manage Users</a></li>
            <li> <a  href="managetopic.php">Manage Topics</a></li>
            <li> <a  href="about.php">About</a></li>
        </ul>    
        </div>


        <div class="admin-content">
            <div class="button-group">
                <a href="addpost.php" class="btn btn-big">Add Post</a>
                <a href="managepost.php" class="btn btn-big">Manage Post</a>
        </div>

        <div class="content">
            <h2 class="page-title"> Add Post</h2>

            <?php
				        echo "<p class='cookie' style='color:red'>$cookieMessage</p>";
		        ?>
            <form action="addpost_backend.php" method="post"enctype="multipart/form-data">
                <div class="form-item">
                        <label>Title</label>
                        <textarea name="text-input" id="text-input" cols="3" rows=""></textarea>
                <div>

                <div class="form-item">
                        <label>Short Description</label>
                        <textarea name="body1" id="body"1 cols="5" rows="5"></textarea>
                </div>

                <div class="form-item">
                        <label>Body</label>
                        <textarea name="body" id="body" cols="50" rows="40"></textarea>
                </div>
                        
                <div class="form-item">
                        <label>Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">

                </div>
                
                <div class="form-item">
                        <label>Topic</label>
                        <select name="topic" class="topic" id="topic">
                            <option value="Poetry">Travel</option>
                            <option value="Poetry">Poetry</option>
                            <option value="Life Lessons">Life Lessons</option>
                            <option value="Others">Others</option>
                        </select>
                </div>
                        <div>
                            <button type="submit"value="Upload Image" name="submit" class="btn btn-big">Add Posts</button>
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
  <script src="./common/common.js"></script>
  <script src="./admin/adminpages.js"></script>
</body>
</html>