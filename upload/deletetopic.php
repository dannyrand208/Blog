<?php
include('Functions.php');

$topic_id = $_GET['topic_id'];
deleteTopic($topic_id);
setCookieMessage('the topic with id "'.$topic_id.' "has been deleted successfully');
redirect("managetopic.php");
?>