<!DOCTYPE html>
<html>
<head>
	<title>Favorites</title>
	 	<link rel="stylesheet" type="text/css" href="style.css">


</head>
<body>
	<header>
		<h1>Favorites</h1>
		<nav>
			<ul>
				<li><a href="home.html">Home</a></li>
				<li><a href="books.html">Books</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li><a href="favorites.php">Favorites</a></li>
			</ul>
		</nav>
	</header>
	<main>
	<div class="container">
	<h1>Favorites</h1>

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

    $sql = "SELECT * FROM `favorites` WHERE 1";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL query failed: " . $conn->error);
    }

    $total_cost = 0;

      if ($result->num_rows > 0) {
    echo "<table><tr><th>Book Serial Number</th><th>Book Name</th><th>Price</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td><button onclick=\"deleteBook(" . $row["id"] . ")\">Delete</button></td></tr>";
        $total_cost += $row["price"];
    }
    echo "</table>";
} else {
    echo "0 results";
}

    $conn->close();
?>
</main>
<footer>
		<p>©Online Book Store By Rudra Patel </p> <!-- ENTER COMPANY NAME HERE-->
</footer>
</body>
</html>

<script>
        function deleteBook(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page to reflect the updated database
                    location.reload();
                }
            };
            xhttp.open("GET", "deletefav.php?id=" + id, true);
            xhttp.send();
        }
    </script>