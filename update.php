<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "book_collection";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$title = "";
$author = "";
$genre = "";
$year = "";

$errorMessage = "";
$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get method: Show the database results

    if ( !isset($_GET["id"])) {
        header("location: crudassignnment/index.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected book from the database table
    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: crudassignment/index.php");
        exit;
    }

    $title = $row["title"];
    $author = $row["author"];
    $genre = $row["genre"];
    $year = $row["year"];
}

else {
    // Post method: update from books
    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];

    do {
        if ( empty($id) || empty($title) || empty($author) || empty($genre) || empty($year) ) {
            $errorMessage = "all fields are required";
            break;
        }

        $sql = "UPDATE books" . 
                "SET title = '$title', author = '$author', genre = '$genre', year = '$year' " . 
                "WHERE id = $id";

        $resut = $connection->query($sql);

        if (!$resut) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

        $successMessage = "Books updated successfully";
        header("location: crudassignment/index.php");
        exit;

    } while (true);
}


?>


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
        <h2>Add Book</h2>
        <?php 
        if ( !empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
                <strong> $errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post"> 
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Author</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Genre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="genre" value="<?php echo $genre; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Publication Year</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
                </div>
            </div>

            <?php 
        if ( !empty($successMessage)) {
            echo "
            <div class= 'row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissable fade show' role='alert'>
                        <strong> $successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
            <div class="row mb-3"> 
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/crudassignment/index.php" role="button">Cancel</a>
                </div>
    
            </div>

        </form>
           
    
</body>
</html>