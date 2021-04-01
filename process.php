<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudsql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = 0;
$update = false;
$author = "";
$title = "";
$genre = "";


//INSERT DATA
if (isset($_POST['submit'])) {

    $author = $_POST['author'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];

    $conn->query("INSERT INTO book (author, title, genre) VALUES ('$author', '$title', '$genre')") or
        die($conn->error);

    $_SESSION['message'] = "Your Data has been recorded";

    header("location: index.php");
}

//DELETE DATA
$result = $conn->query("SELECT * FROM book") or die($conn->error);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM book WHERE id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Your Data has been Deleted";

    header("location: index.php");
}

//EDIT DATA
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM book WHERE id=$id") or
        die($conn->error);
    echo "Data Retrieved";

    $row = $result->fetch_array();
    $author = $row['author'];
    $title = $row['title'];
    $genre = $row['genre'];
}

//UPDATE DATA
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];

    $conn->query("UPDATE book SET author='$author', title='$title', genre='$genre' WHERE id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Record already edited!";

    header("location: index.php");
}

// $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

// if ($conn->query($sql) === TRUE) {
//   echo "Record updated successfully";
// } else {
//   echo "Error updating record: " . $conn->error;
// }

// $conn->close();
// 
