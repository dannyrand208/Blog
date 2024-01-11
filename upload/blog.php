
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
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <nav class="navbar">
       
        <a class="logo" href="home.php">
            <img class="logo-img" src="https://seeklogo.com/images/B/blogger_B-logo-47610B2F87-seeklogo.com.png" alt="ok">
        </a>
        <ul class="link-container">
            <li class="link-item"><a href="home.php" class="link">Home</a>
            <?php 
		if (empty($cookieUser)) {
			// User is not logged in, display Sign Up and Sign In links.
			echo '<li class="link-item"><a href="/myprogram/upload/login.php" class="link">Login</a></li>';
            
		} else {
			// User is logged in, display Sign Out and user information.
            echo '<li class="link-item"><a href="adminpages.php" class="link">Admin</a></li>';
            echo '<div class="dropdown" id="userDropdown">
            <a class="dropbtn">' . $cookieUser . ' &#9662;</a>
            <div class="dropdown-content" id="dropdownContent">
                <a href="logoutUser.php">Logout</a>
            </div>
          </div>'; 
}
            
		?>
        
        </ul>
    </nav>
    <head> 
    <section class="blog-section">
        <div class="blog-card">
            <img class= "blog-image" src="https://i.ytimg.com/vi/KE0hB9kXUVo/maxresdefault.jpg" alt="">
            <h1 class="blog-title">AUSTRALIA TRAVEL BLOG | a week in Melbourne & Sydney! 🇦🇺</h1>
            <p class="blog-overview">The first vlog in the Australia travel series! 🤩

                For 7 weeks my boyfriend Sid and I will be travelling up the East Coast of Australia with the help of travel agency My Adventure Project! Start building your customised trip with them here: https://myadventureproject.com/ </p>
            <a href="/" class="oke">Read more</a>
        </div>

        <div class="blog-card">
            <img class= "blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
            <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
            <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a while, some of you may know I've been traveling around America! So I thought I'd update you all on my trip so far and give you my initial thoughts and what we've been getting up too!
                I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not) and I wanted to share them with you!</p>
           <a href="/" class="oke">Read more</a>
        </div>

        <div class="blog-card">
            <img class= "blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
            <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
            <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a while, some of you may know I've been traveling around America! So I thought I'd update you all on my trip so far and give you my initial thoughts and what we've been getting up too!
                I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not) and I wanted to share them with you!</p>
           <a href="/" class="oke">Read more</a>
        </div>


        <div class="blog-card">
            <img class= "blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
            <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
            <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a while, some of you may know I've been traveling around America! So I thought I'd update you all on my trip so far and give you my initial thoughts and what we've been getting up too!
                I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not) and I wanted to share them with you!</p>
           <a href="/" class="oke">Read more</a>
        </div>

        <div class="blog-card">
            <img class= "blog-image" src="https://i.ytimg.com/vi/LZLKfPXyqRo/maxresdefault.jpg" alt="">
            <h1 class="blog-title">AMERICA BLOG🇺🇸Part 1 (Stuck in Phoenix!)</h1>
            <p class="blog-overview">What's going on guys!! I'm back with another video, sorry it's been a while, some of you may know I've been traveling around America! So I thought I'd update you all on my trip so far and give you my initial thoughts and what we've been getting up too!
                I've been here 2 months now and I’ve also got some thoughts about eating healthy (and not) and I wanted to share them with you!</p>
           <a href="/" class="oke">Read more</a>
        </div>


        </head>
       

    </section>

    
</body>
</html>