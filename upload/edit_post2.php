<?php 
include("Functions.php");
// $cookieUser = getCookieUser();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_Id = $_POST['postid'];
    $title = $_POST['textinput1'];
    $shortDescription = $_POST['body1'];
    $body = $_POST['body'];
    $type = $_POST['topic'];

    $hinhanhath = basename($_FILES['fileToUpload']['name']);
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/myprogram/upload/img/";
    $target_file = $target_dir . $hinhanhath;


    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        $dbh = connectToDatabase();
        $statement1 = $dbh->prepare("UPDATE Post SET Title = ?, Shortdescription = ?, Body = ?, Image_url = ?, Topic = ? WHERE PostID = ?");
        $statement1->bindValue(1, $title);
        $statement1->bindValue(2, $shortDescription);
        $statement1->bindValue(3, $body);
        $statement1->bindValue(4, $hinhanhath);
        $statement1->bindValue(5, $type);
        $statement1->bindValue(6, $post_Id);
        $statement1->execute();
    } else {
        setCookieMessage("Failed to upload the image");
        redirect('managepost.php');

    }
    setCookieMessage('The post " '.$title.' " has been edited sucessfully ');
    redirect('managepost.php');


}

?>