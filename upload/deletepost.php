<?php
include('Functions.php');

$post_id = $_GET['post_id'];
deletePost($post_id);
setCookieMessage('the post with id "'.$post_id.' "has been deleted successfully');
redirect("managepost.php");
?>