<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	 	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Cart</h1>
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
	<h1>Book Store Cart</h1>

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

    $sql = "SELECT * FROM `books` WHERE 1";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL query failed: " . $conn->error);
    }

    $total_cost = 3 * $result->num_rows;

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Book Serial Number</th><th>Book Name</th><th>Price</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td><button onclick=\"deleteBook(" . $row["id"] . ")\">Delete</button></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
?>


<p> NOTE: Please note that all the books can only be rented for a period of one month from the buy date! Note down the buy date for your own convenienve! There is a flat fee of 5$ for each extra day the book is out. ALSO NOTE THAT THERE IS ONLY ONE PRICE TO RATE ANY BOOK FROM OUR STORE! THAT IS 3$ per Book FOR A MONTH! </p>

<div class="checkout">
    <h2>Checkout</h2>
    <form method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="payment">Payment Method:</label>
        <select id="payment" name="payment_method" required>
            <option value="">--Select Payment Method--</option>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
            <option value="paypal">Paypal</option>
        </select>

        <input type="submit" name="Rent" value="Buy">
    </form>
</div>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $payment_method = $_POST['payment_method'];

        if(isset($_POST['buy'])) {
            // Clear the database table
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_name = "projects";
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "TRUNCATE TABLE books";
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            // Show confirmation dialog
            echo "<script>
                    var confirmBuy = confirm('The cost of the books is: $total_cost $, are you sure you want to purchase this?');
                    if(confirmBuy) {
                        // Clear the database table
                        var xhttp = new XMLHttpRequest();
                        xhttp.open('GET', 'clear.php', true);
                        xhttp.send();
                        alert('Order has been placed. Thank you!');
                    }
                </script>";
	     
        }
}
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
            xhttp.open("GET", "delete.php?id=" + id, true);
            xhttp.send();
        }
    </script>