<?php
try {
    include("Functions.php");

    $username = getCookieUser();
    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $currentTime = date("H:i:s");


    $dbh = connectToDatabase();

    $statement = $dbh->prepare("SELECT * FROM Topic WHERE Topic = ?");
    $statement->bindValue(1, $topic);
    $statement->execute();

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        setCookieMessage('Topic Name is already exist');
        redirect('adminpages.php');
    } else {

        $hinhanhath = basename($_FILES['fileToUpload']['name']);
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/myprogram/upload/img/";
        $target_file = $target_dir . $hinhanhath;

        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {

            $statement1 = $dbh->prepare("INSERT INTO Topic (Topic, description, currentTime, image_url, username) VALUES (?, ?, ?, ?,?)");
            $statement1->bindValue(1, $topic);
            $statement1->bindValue(2, $description);
            $statement1->bindValue(3, $currentTime);
            $statement1->bindValue(4, $hinhanhath);
            $statement1->bindValue(5, $username);
            $statement1->execute();
        } else {
            setCookieMessage("Failed to upload the image");
            redirect('adminpages.php');

        }
    }

    setCookieMessage("The New Topic with name " . $topic . " has been added");
    redirect("adminpages.php");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>