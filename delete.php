<?php

// Check if book ID is set
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "book_collection";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM books WHERE id =$id";
    $connection->query($sql);
}

header("location: /crudassignment/index.php");
exit;
?>