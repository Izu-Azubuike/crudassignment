<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Collection</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Book Collection</h2>
    <a class="btn btn-primay" href="/crudassignment/create.php" role="button">Add Book</a>
    <br>
    <table class="table">   
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "book_collection";
            
            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: ". $connection->connect_error);
            }

            // read all row from database table
            $sql = "SELECT * FROM books";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["id"]. "</td>";
                echo "<td>". $row["title"]. "</td>";
                echo "<td>". $row["author"]. "</td>";
                echo "<td>". $row["genre"]. "</td>";
                echo "<td>". $row["year"]. "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary btn-sm' href='/crudassignment/update.php?id=$row[id]'>Edit</a>";
                echo "<a class='btn btn-danger btn-sm' href='/crudassignment/delete.php?id=$row[id]'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            
            ?>


        </tbody>
    </table>
    </div>
</body>
</html>
