<?php 
include('Functions.php');

        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
        $dbh = connectToDatabase();

        $statement2 = $dbh->prepare('INSERT INTO image (image_url) VALUES (?)');
        $statement2->bindValue(1, $img_name);
        $statement2->execute();

    
      
        $statement = $dbh->prepare('SELECT image_url FROM image ORDER BY 1 DESC LIMIT 1');
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $img_url = $result['image_url'];
            require_once('editor.php');
        
        } else {
            echo "No image found.";
        }

    ?>



