<?php
include 'config.php';

// Fetch user profile data
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Connect to MySQL database
    $conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start session
    session_start();

    // Get user ID from session
    $userId = $_SESSION['user_id'];

    // Prepare SQL statement to retrieve user information based on user ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    // Execute SQL statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Return user data as JSON
        echo json_encode($row);
    } else {
        // Return error message
        echo "User not found";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
