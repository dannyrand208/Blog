
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
    <link rel="stylesheet" href="adminpages.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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

   
    <div class="sidebar">
        <header>Manage </header>  
        <ul >
            <li> <a  href="admin_manage_posts.php"><i class="fas fa-qrcode">Manage Post</a></li>
            <li> <a  href="admin_manage_users.php"><i class="fas fa-qrcode">Manage Users</a></li>
            <li> <a  href="admin_manage_topics.php"><i class="fas fa-qrcode">Manage Topics</a></li>
            <li> <a  href="about.php"><i class="fas fa-qrcode">About</a></li>
        </ul>
           
         
            
        </div>




    
 
    
  <div class="admin-content">
    <div class="button-group"></div>
  </div>
  <script src="./common/common.js"></script>
  <script src="./admin/adminpages.js"></script>
</body>
</html>