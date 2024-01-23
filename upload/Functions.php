<?php

// here is a function that will connect the Database
// wherever we need to connect to the database we just call this function.
function connectToDatabase()
{
	$servername = "localhost";
	$username = "root";
	$password = "";

	
	$conn = new PDO("mysql:host=$servername;dbname=forum", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	return $conn;

}

// this function lets you redirect the user to a different web page.
function redirect($newURL)
{
	// the header location function will send a user to the specified URL.
	// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
	header("Location: $newURL");
	
	// we just redirected the user, that means there is no one around to view this page.
	// so we can just stop processing this page.
	die();
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function setCookieMessage($cookieMessage)
{
	setcookie("CookieMessage", $cookieMessage);
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function setCookieUser($cookieUser)
{
	setcookie("CookieUser", $cookieUser);
}


function setCookieTheme($theme)
{
    setcookie("theme", $theme); // Set the cookie with an expiration time of 1 hour
}

function getCookieTheme()
{
    if (isset($_COOKIE['Color'])) {
        $color = $_COOKIE['Color'];
        return makeOutputSafe($color);
    } else {
        return ""; // Return an empty string or a default value as needed
    }
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function getCookieMessage()
{
	if(isset($_COOKIE['CookieMessage']))
	{
		$message = $_COOKIE['CookieMessage'];
		deleteCookie("CookieMessage");
		return makeOutputSafe($message);
	}
	else return "";	
}	

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function getCookieUser()
{
	if(isset($_COOKIE['CookieUser']))
	{
		$user = $_COOKIE['CookieUser'];
		return makeOutputSafe($user);
	}
	else return "";	
}	

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function deleteCookie($cookieName)
{
	// to delete a cookie, you set the expiry date to a date in the past.
	// in this case set the expiry date to 1 second past midnight 1st of Jan 1970
	setcookie($cookieName,"",-1);
}

// run this function on untrusted data before we echo it on the page.
function makeOutputSafe($unsafeString)
{
	$safeOutput = htmlspecialchars($unsafeString, ENT_QUOTES,"UTF-8");
	return $safeOutput;
}	

function getUserTheme() {
    
	return isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
}

function isDarkMode() {
    $theme = getCookieTheme();
    return $theme == "dark";
}

if (isset($_POST['action']) && $_POST['action'] == 'setTheme') {
    // Handle AJAX request to set theme
    $theme = $_POST['theme'];
    setCookieTheme($theme);
    echo json_encode(['success' => true]);
    exit;
}




function getTopicDetails($topicId) {
    $dbh = connectToDatabase();
    $statement = $dbh->prepare("SELECT * FROM Topic WHERE TopicID = ?");
    $statement->execute([$topicId]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function updateTopic($topicId, $newTopicName) {
    $dbh = connectToDatabase();
    $statement5 = $dbh->prepare("UPDATE Topic SET Topic = ? WHERE TopicID = ?");
    $statement5->execute([$newTopicName, $topicId]);
}
function updateUser($UserId, $newUsername, $newEmail, $newPassword, $newPassword2, $newRole) {
    $dbh = connectToDatabase();
    $statement4 = $dbh->prepare("UPDATE User SET username = ?, email = ?, password = ?, password2 = ?, Role = ? WHERE UserID = ?");
    $statement4->execute([$newUsername, $newEmail, $newPassword, $newPassword2, $newRole, $UserId]);
    
	setCookieMessage('The user has been updated sucessfully');
	redirect('manageuser.php');



}
function deleteTopic($topicId) {
    $dbh = connectToDatabase();
    $statement5 = $dbh->prepare("DELETE FROM `Topic` WHERE TopicID = ?");
    $statement5->execute([$topicId]);
	setCookieMessage('the topic ID: '.$topicId.' has been deleted sucessfuly');
	redirect('managetopic.php');
}

function deleteUser($userId) {
    $dbh = connectToDatabase();
    $statement5 = $dbh->prepare("DELETE FROM `User` WHERE UserID = ?");
    $statement5->execute([$userId]);
	setCookieMessage('the user id: '.$userId.' has been deleted sucessfuly');
	redirect('manageuser.php');
}


function deletePost($postId) {
    $dbh = connectToDatabase();
    $statement5 = $dbh->prepare("DELETE FROM `Post` WHERE PostID = ?");
    $statement5->execute([$postId]);
	
}
?>



