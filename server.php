<?php
// server.php

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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Register
    if (isset($_POST["action"]) && $_POST["action"] == "register") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["message" => "Registration successful"]);
    }

    // Login
    if (isset($_POST["action"]) && $_POST["action"] == "login") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $password == $user["password"]) {
            echo json_encode(["message" => "Login successful"]);
        } else {
            echo json_encode(["message" => "Invalid email or password"]);
        }

        $stmt->close();
    }

    // Schedule
    if (isset($_POST["action"]) && $_POST["action"] == "schedule") {
        $user_id = 1; // Replace with the actual user ID after implementing session management
        $date = $_POST["date"];
        $time = $_POST["time"];
        $location = $_POST["location"];
        $food = $_POST["food"];

        $sql = "INSERT INTO schedules (user_id, date, time, location, food) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $date, $time, $location, $food);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["message" => "Schedule created successfully"]);
    }
}

$conn->close();
?>
