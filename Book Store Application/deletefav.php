<?php
// Connect to MySQL database
$servername = "sql1.njit.edu";
$username = "rmp32";
$password = "Rudyrocks1!";
$dbname = "rmp32";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the id parameter from the URL
$id = $_GET['id'];

// Delete the row with the given id from the books table
$sql = "DELETE FROM `favorites` WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Book deleted successfully";
} else {
    echo "Error deleting book: " . $conn->error;
}

$conn->close();
?>
