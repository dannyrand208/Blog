<?php
	include('Functions.php');
	$cookieMessage = getCookieMessage();
		$cookieUser = getCookieUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog: Homepage</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header class="header">
        <div class="content">
            <img class="logo" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png" alt="ok">
                <form action="loginUser.php" method = "post">
                    <h2> Login</h2>
                    
                    <label for="username">Username</label>
                    <input type="text" name ="username" id="username" class="username" required >

                     <label for="password">Password</label>
                     <input type="password" id="password" name="password" required >
                     
                     <?php
				        echo "<p class='cookie'>$cookieMessage</p>";
		             ?>
    
                     <button class="submit" type="submit">Login</button>
                     

                     <p> Don't have an account?</p>


                     <a class='register' href="register.php">Register</a>

                     <a href="home.php" class="back">Back to Home</a>
                    
                    </form>
                    
             
        </div>
    </header>

    

    
</body>
</html>
