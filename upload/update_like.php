<?php
use LDAP\Result;
include('Functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $post_id = $_POST['post_id'];
    $status = $_POST['status'];
    $username = $_POST['user_name'];
    // kiem tra trong db cai thang nay da like hoac dislike chua? => tim trong db co cai row username = $username va post_id = $post_id
    // neu da like/dis => update
    // else insert
    $dbh = connectToDatabase();



    $statement1 = $dbh->prepare("SELECT * FROM Likes WHERE PostId = ? AND username = ?");
    $statement1->bindValue(1, $post_id);
    $statement1->bindValue(2, $username);
    $statement1->execute();
    $result = $statement1->fetch(PDO::FETCH_ASSOC);
    $action = '';
    
    if ($result === false) {
        $statement2 = $dbh->prepare("INSERT INTO `Likes`(`PostID`, `username`, `rating_action`) VALUES (?,?,?)");
        $statement2->bindValue(1, $post_id);
        $statement2->bindValue(2, $username);
        $statement2->bindValue(3, $status);
        $statement2->execute();
        $result1 = $statement2->fetch(PDO::FETCH_ASSOC);
        $action = "insert";
    } elseif(($result["rating_action"] ==="like" && $status == 'like') || ($result["rating_action"] ==="dislike" && $status == 'dislike') ) {
        $statement3 = $dbh->prepare("DELETE FROM Likes WHERE PostId = ? AND username=?");
        $statement3->bindValue(1, $post_id);
        $statement3->bindValue(2, $username);
        $statement3->execute();
        $result1 = $statement3->fetch(PDO::FETCH_ASSOC);
        $action = "back_to_normal";

    } else {

        $statement = $dbh->prepare("UPDATE Likes SET rating_action= ? WHERE PostId = ? AND username=?");
        $statement->bindValue(1, $status);
        $statement->bindValue(2, $post_id);
        $statement->bindValue(3, $username);
        $statement->execute();
        $action = "update";
    }
    
    $response = (object) [
         "action" => $action,
    ];
    
    $response = json_encode($response);

    echo $response;

} else {

       

    
}
?>
