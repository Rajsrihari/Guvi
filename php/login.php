<?php
include 'config.php';

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from AJAX request
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Connect to MySQL database
    $conn = new mysqli($servername, $username_mysql, $password_mysql, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve user information based on username
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute SQL statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Start session
            session_start();
            // Store user ID in session
            $_SESSION['user_id'] = $row['id'];
            // Return success message
            echo "Login successful";
        } else {
            // Return error message for invalid password
            echo "Invalid password";
        }
    } else {
        // Return error message for user not found
        echo "User not found";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
