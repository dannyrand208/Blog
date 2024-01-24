<?php
// update_like.php

include('Functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the post ID from the form submission
    $post_id = $_POST['post_id'];

    // Update the like count in the Post table
    $dbh = connectToDatabase();
    $statement = $dbh->prepare('UPDATE Post SET LikeCount= LikeCount + 1 WHERE PostID = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    // Redirect back to the blog post after updating the like
    redirect('singleblog.php');

} else {
    // If the page is accessed directly, redirect to the homepage or an error page
       
    redirect('home.php');
    
}
?>
