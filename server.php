<?php
// server.php
session_start();

// Database connection settings
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

// Handle user registration
if (isset($_POST['register_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypt the password

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful";
        header("Location: success.php");
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: error.php");
    }
}

// Handle client login
if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Login successful";
        header("Location: success.php");
    } else {
        $_SESSION['message'] = "Invalid email or password";
        header("Location: error.php");
    }
}

// Handle physician login
if (isset($_POST['physician_login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM physicians WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Physician login successful";
        header("Location: success.php");
    } else {
        $_SESSION['message'] = "Invalid email or password";
        header("Location: error.php");
    }
}

// Handle scheduling
if (isset($_POST['schedule_appointment'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $food = $_POST['food'];

    $sql = "INSERT INTO appointments (date, time, location, food) VALUES ('$date', '$time', '$location', '$food')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Appointment scheduled";
        header("Location: success.php");
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: error.php");
    }
}

$conn->close();
