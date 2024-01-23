<?php 
include("Functions.php");
$dbh = connectToDatabase();
$cookieUser = getCookieUser();

$statement = $dbh ->prepare('SELECT Role FROM User WHERE Username = ?');
$statement -> bindValue(1,$cookieUser) ;
$statement -> execute();

$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
    }
var_dump($data[0]['Role']);




?>