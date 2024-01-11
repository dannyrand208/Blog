<?php 
include('Functions.php');


try {
    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
        var_dump($_FILES['my_image']);
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
        $dbh = connectToDatabase();

        // Insert the new user
        $statement2 = $dbh->prepare('INSERT INTO image (image_url) VALUES (?)');
        $statement2->bindValue(1, $img_name);
        $statement2->execute();

        echo "alert('The sername has been added. Please sign in to start posting.'U)";
        setCookieMessage("The Username " .$img_name . " has been added. Please sign in to start posting.");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


try {
    $dbh = connectToDatabase();

    // Retrieve the image URL from the database
    $statement = $dbh->prepare('SELECT image_url FROM image ORDER BY 1 DESC LIMIT 1');
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $img_url = $result['image_url'];
        // Display the image
        echo "<img src='$img_url' alt='Uploaded Image'>";
    } else {
        echo "No image found.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>






