<?php
include("Functions.php");
session_start();
$userid = $_SESSION['userid'];
$dbh = connectToDatabase();
$username = getCookieUser();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $hinhanhath = basename($_FILES['photoInput']['name']);
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/myprogram/upload/img/";
    $target_file = $target_dir . $hinhanhath;


    if (move_uploaded_file($_FILES['photoInput']['tmp_name'], $target_file)) {
        // Update the database
        $statement1 = $dbh->prepare("UPDATE `User` SET avatar=? WHERE UserID = ? AND username = ?");
        $statement1->bindValue(1, $hinhanhath);
        $statement1->bindValue(2, $userid);
        $statement1->bindValue(3, $username);
        $statement1-> execute();
        redirect('editprofile.php');


    }
}
?>