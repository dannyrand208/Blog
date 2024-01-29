
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
    <link rel="stylesheet" href="adminpages.css">
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
        <ul >
        <li> <a  href="editprofile.php">Edit Profile</a></li>
            <li> <a  href="managepost.php">Manage Post</a></li>
            <li> <a  href="manageuser.php">Manage Users</a></li>
            <li> <a  href="managetopic.php">Manage Topics</a></li>
            <li> <a  href="about.php">About</a></li>
        </ul>    
        </div>


        <div class="admin-content">
            <div class="button-group">
                <a  class="btn btn-big">Contact</a>
                <a href="home.php" class="btn btn-big">Back to home</a>
        </div>

        <div class="content">
            <h2 class="page-title"> About</h2>
            <h2> This version now is 1.2.6.7. and all the copyright belong to Tuan Thanh Dac Nguyen. Please contact the phone number 0450667138 for the furter queries and questions about the pages</h2>

            
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
  <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            console.log(subMenu);
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>