<?php
// view_accounts.php

// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all accounts from the 'users' table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Display accounts in an HTML table
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
