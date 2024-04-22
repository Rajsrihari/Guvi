<?php
include 'config.php';

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from AJAX request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to MySQL database
    $conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert new user into database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Return success message
        echo "Registered successfully";
    } else {
        // Return error message
        echo "Error: " . $conn->error;
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
