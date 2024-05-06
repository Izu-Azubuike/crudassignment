<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "book_collection";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$title = "";
$author = "";
$genre = "";
$year = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    do {
        if ( empty($title) || empty($author) || empty($genre) || empty($year) ) {
            $errorMessage = "all fields are required";
            break;
        }

        // add new book to database
        $sql = "INSERT INTO books (title, author, genre, year) VALUES ('$title', '$author', '$genre', '$year')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $title = "";
        $author = "";
        $genre = "";
        $year = "";

        $successMessage = "Book added successfully";

        header ("location: /crudassignment/index.php");
        exit;


    } while (false);
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