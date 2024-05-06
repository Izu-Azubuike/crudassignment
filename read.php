<?php
include 'db_connection.php';

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-striped'>";
    echo "<tr><th>Title</th><th>Author</th><th>Genre</th><th>Publication Year</th><th>Action</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['genre'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td><a href='update.php?id=". $row['id'] ."' class='btn btn-sm btn-info'>Edit</a> <a href='delete.php?id=". $row['id'] ."' class='btn btn-sm btn-danger'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
