<?php
  include('Functions.php');
  $search = $_GET['search'];
  var_dump($search);

  $sql = connectToDatabase();
  $statement = $sql-> prepare("SELECT * FROM Post WHERE Title LIKE '%$search%'");
  $statement ->execute();

    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Description: " . $row["description"]. "<br>";
    }


?>