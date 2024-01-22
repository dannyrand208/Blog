<?php 
include('Functions.php');

if(isset($_POST["submit"])) {
    $cookieUser = getCookieUser();

    $title = $_POST['text-input'];
    $body = $_POST['body'];
    $topic = $_POST['topic'];
    $shortbody = $_POST['body1'];
    $currentTime = date("Y-m-d H:i:s");
    $username  = $cookieUser;

    $dbh = connectToDatabase();

    // Check if the title already exists
    $statement = $dbh->prepare('SELECT * FROM Post WHERE title = ?');
    $statement->bindValue(1, $title);
    $statement->execute();

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        setCookieMessage("Title already exists");
        redirect("addpost.php");
    }

    // Process image upload
    $hinhanhath = basename($_FILES['fileToUpload']['name']);
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/myprogram/upload/img/";
    $target_file = $target_dir . $hinhanhath;


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        $statement2 = $dbh->prepare('INSERT INTO Post (Title, Shortdescription, Body, Image_url, Topic, currentTime,username) VALUES (?,?, ?, ?,? ,?,?)');
        $statement2->bindValue(1, $title);
        $statement2->bindValue(2, $shortbody);
        $statement2->bindValue(3, $body);
        $statement2->bindValue(4, $hinhanhath); 
        $statement2->bindValue(5, $topic);
        $statement2->bindValue(6, $currentTime);
        $statement2->bindValue(7, $username );
        $statement2->execute();

        setCookieMessage("The new post has been added successfully");
        redirect("addpost.php");
    } else {
        setCookieMessage("Failed to upload image");
        redirect("addpost.php");
    }
}
?>
