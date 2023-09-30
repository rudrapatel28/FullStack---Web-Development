		<?php
// Establish database connection
$conn = mysqli_connect("sql1.njit.edu", "rmp32", "Rudyrocks1!", "rmp32"); // Replace with your database credentials

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $bookId = $_POST["bookid"];
  $bookName = $_POST["name"];
  $bookPrice = $_POST["price"];

  // Insert the book id, name, and price into the database
  $sql = "INSERT INTO books (id, name, price) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "iss", $bookId, $bookName, $bookPrice);
  $result = mysqli_stmt_execute($stmt);

  // Check if insert was successful
  if ($result) {
    echo "Book details submitted successfully";
  } else {
    echo "Error: Book Already Exists In Favorites";
  }

  // Close statement
  mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($conn);
?>
