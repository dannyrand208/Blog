
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

 <div class=admin-wrapper>fvgftttf00q   ajkl
    dhjgfghf7I0J
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
                <a href="adminpages.php" class="btn btn-big">Add Topic</a>
                <a href="managetopic.php" class="btn btn-big">Manage Topic</a>
        </div>

        <div class="content">
            <h2 class="page-title"> Add topic</h2>
            <?php
				        echo "<p class='cookie' style='color:red'>$cookieMessage</p>";
		        ?>
            <form action="addtopic_backend.php" method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <label>Topic Name</label>
                <textarea name="topic" id="topic" cols="5" rows="5"></textarea>
            </div>
            <div class="form-item" style="margin-top: 10px">
                <label for="">Description</label>
                <textarea name="description" id="description" cols="10" rows="40"></textarea>
            </div>
                <label for="fileToUpload">Image</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            <div>
            
            <div>
                <button type="submit" class="btn btn-big">Add Topic </button>
            </div>
                
            </label>
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