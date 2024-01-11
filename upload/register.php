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
                <form action="registerUser.php" method = "POST">
                    <h2> Register</h2>
                    
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"  >
                    
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email"  >

                     <label for="password">Password</label>
                     <input type="text" id="password" name="password"  >
                     
                     <label for="password2">Password Again</label>
                     <input type="passwsord1" id="password1" name="password1" >
                       
                     <?php
				        echo "<p class='cookie'>$cookieMessage</p>";
		             ?>
                     <button class="register" type="submit">Register</button>
                      
                     <p class="">Already have account?</p>

                     <a class='submit' href="login.php">Login</a>  
                     
                     <a href="home.php" class="back">Back to Home</a>
    
                </form>
        </div>
    </header>

    

    
</body>
</html>