<?php
// Database credentials
$servername = "localhost";  // Server address (use 'localhost' for a local server)
$db_username = "root";       // Database username (default for MySQL is 'root')
$db_password = "";           // Database password (set it to what you've configured)
$dbname = "userbase";        // Your database name

// Create connection to the MySQL database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form input
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind a statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

// Execute the statement
$stmt->execute();

// Check if a row with the provided credentials exists
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Successful login
    echo "Welcome, " . $username . "!";
} else {
    // Failed login
    echo "Invalid username or password. Please try again.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
