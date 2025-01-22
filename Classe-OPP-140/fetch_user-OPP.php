<?php
// Import the configuration file
require '../config/config.php';

// Define a class to handle user-related operations
class UserHandler {
    private $conn; // Private property to hold the database connection

    // Constructor to initialize the database connection
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to fetch all users from the database
    public function fetchUsers() {
        // SQL query to select all users ordered by creation date in descending order
        $sql = "SELECT * FROM Users ORDER BY createdAt DESC";
        
        // Execute the query and store the result
        $result = $this->conn->query($sql);

        // Initialize an empty array to store the users
        $users = [];

        // Check if there are any rows in the result
        if ($result->num_rows > 0) {
            // Loop through each row and add it to the users array
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        // Return the array of users
        return $users;
    }
}

// Usage example
try {
    // Create an instance of the UserHandler class
    $userHandler = new UserHandler($conn);

    // Fetch users using the fetchUsers method
    $users = $userHandler->fetchUsers();

    // Debug or display users (for testing purposes)
    // print_r($users);
} catch (Exception $e) {
    // Handle exceptions (e.g., log errors, display friendly messages, etc.)
    echo "Error: " . $e->getMessage();
}
?>
