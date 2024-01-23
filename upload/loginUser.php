<?php
include('Functions.php');

try {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbh = connectToDatabase();

    $statement = $dbh->prepare('SELECT * FROM User WHERE UserName = ?');
    $statement->bindValue(1, $username);
    echo "SQL Query: " . $statement->queryString . "<br>";
    echo "Username: " . $username . "<br>";
    $statement->execute();

    $statement1 = $dbh->prepare('SELECT Role FROM User WHERE Username = ?');
    $statement1->bindValue(1, $username);
    $statement1->execute();

    $data = array();
    while ($row = $statement1->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
   

    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) { // Check username
        if ($password == $row['password']) {
            var_dump($row);
            setCookieMessage('Welcome back ' . $username); // Corrected variable name
            setCookieUser($username);
            session_start();
            $_SESSION['user_name'] = $username;
            $_SESSION['role'] = $data[0]['Role'];
            redirect("home.php");

        } else {
            setCookieMessage('Invalid password for the username ' . $username); // Corrected variable name
            redirect("login.php");
        }
    } else {
        setCookieMessage("Username " . $username . " does not exist"); // Corrected variable name
        redirect("login.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>