<?php
include('Functions.php');
$dbh = connectToDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id1 = $_POST['post_id1'];
    $status = $_POST['status1'];
    $user_comment = $_POST['user_comment'];
    $commentID = $_POST['commentid'];
    $user_like = $_POST['user_like'];


    $statement1 = $dbh->prepare("SELECT * FROM Like_comment WHERE CommentID= ? AND PostId = ? AND User_comment = ? AND User_like =?");
    $statement1->bindValue(1, $commentID);
    $statement1->bindValue(2, $post_id1);
    $statement1->bindValue(3, $user_comment);
    $statement1->bindValue(4, $user_like);
    $statement1->execute();
    $result = $statement1->fetch(PDO::FETCH_ASSOC);
    $action = '';

    if ($result === false) {
        $statement = $dbh->prepare("INSERT INTO `Like_comment`(`CommentID`, `PostID`, `User_comment`, `User_like`, `rating_action`) VALUES (?,?,?,?,?) ");
        $statement->bindValue(1, $commentID);
        $statement->bindValue(2, $post_id1);
        $statement->bindValue(3, $user_comment);
        $statement->bindValue(4, $user_like);
        $statement->bindValue(5, $status);
        $statement->execute();
        $result1 = $statement->fetch(PDO::FETCH_ASSOC);
        $action = 'insert';
    } else if (($result['rating_action'] === 'like' && $status === 'like') || ($result['rating_action'] === 'dislike' && $status === 'dislike')) {
        $statement = $dbh->prepare("DELETE FROM Like_comment WHERE CommentID= ? AND PostId = ? AND User_comment = ? AND User_like =?");
        $statement->bindValue(1, $commentID);
        $statement->bindValue(2, $post_id1);
        $statement->bindValue(3, $user_comment);
        $statement->bindValue(4, $user_like);
        $statement->execute();
        $result2 = $statement->fetch(PDO::FETCH_ASSOC);
        $action = 'back_to_normal';
    }else {
        $statement = $dbh->prepare("UPDATE Like_comment SET`rating_action`= ? WHERE `CommentID`= ? AND `PostID`= ? AND `User_comment`= ? AND `User_like`= ?");
        $statement->bindValue(1, $status);
        $statement->bindValue(2, $commentID);
        $statement->bindValue(3, $post_id1);
        $statement->bindValue(4, $user_comment);
        $statement->bindValue(5, $user_like);
        $statement->execute();
        $result3= $statement->fetch(PDO::FETCH_ASSOC);
        $action = 'update';
    }
}
    $response = (object) [
        "action" => $action
   ];
   
   $response = json_encode($response);

   echo $response;

  


?>