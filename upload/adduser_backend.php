<?php 
include('Functions.php');

try {
   

    $userName = $_POST['username'];
    $email = $_POST['email'];
    $passWord = $_POST['password'];
    $passWord2 = $_POST['password1'];
    $role = $_POST['role'];
    

    $dbh = connectToDatabase();

    // Check if the username already exists
    $statement = $dbh->prepare('SELECT * FROM User WHERE UserName = ?');
    $statement->bindValue(1, $userName);
    $statement->execute();

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        setCookieMessage("UserName already exists");
        redirect("adduser.php");
    }

    // Insert the new user
    $statement2 = $dbh->prepare('INSERT INTO User (UserName, Email, Password, Password2,Role) VALUES (?, ?, ?, ?,?)');
    $statement2->bindValue(1, $userName);
    $statement2->bindValue(2, $email);
    $statement2->bindValue(3, $passWord);
    $statement2->bindValue(4, $passWord2);
    $statement2->bindValue(5, $role);
    $statement2->execute();

    echo "<script>alert('The sername has been added. Please sign in to start posting.'U);</script>";
    setCookieMessage("The User " . $userName . " has been added");
    redirect("adduser.php");
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

