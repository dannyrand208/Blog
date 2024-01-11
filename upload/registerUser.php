<?php 
include('Functions.php');

try {

    $userName = $_POST['username'];
    $email = $_POST['email'];
    $passWord = $_POST['password'];
    $passWord2 = $_POST['password1'];

    $dbh = connectToDatabase();

    // Check if the username already exists
    $statement = $dbh->prepare('SELECT * FROM User WHERE UserName = ?');
    $statement->bindValue(1, $userName);
    $statement->execute();

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        setCookieMessage("UserName already exists");
        redirect("register.php");
    }

    // Insert the new user
    $statement2 = $dbh->prepare('INSERT INTO User (UserName, Email, Password, Password2) VALUES (?, ?, ?, ?)');
    $statement2->bindValue(1, $userName);
    $statement2->bindValue(2, $email);
    $statement2->bindValue(3, $passWord);
    $statement2->bindValue(4, $passWord2);
    $statement2->execute();

    echo "<script>alert('The sername has been added. Please sign in to start posting.'U);</script>";
    setCookieMessage("The Username " . $userName . " has been added. Please sign in to start posting.");
    redirect("register.php");
    setCookieUser($userName);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>