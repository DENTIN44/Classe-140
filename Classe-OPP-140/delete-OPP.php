<?php
require '../config/config.php'; // Include the database connection file

// Define a class to handle user deletion
class UserManager {
    private $conn; // Private property to hold the database connection

    // Constructor to initialize the database connection
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to delete a user by ID
    public function deleteUser($userId) {
        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM Users WHERE id = ?";

        // Prepare the statement
        if ($stmt = $this->conn->prepare($sql)) {
            // Bind the user ID parameter
            $stmt->bind_param("i", $userId);

            // Execute the statement
            if ($stmt->execute()) {
                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    echo "User with ID $userId has been deleted.";
                    header('Location: index.php'); // Redirect after successful deletion
                    exit;
                } else {
                    echo "No user found with ID $userId.";
                }
            } else {
                throw new Exception("Error executing the query: " . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } else {
            throw new Exception("Error preparing the statement: " . $this->conn->error);
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = intval($_POST['user_id']); // Convert user ID to an integer to prevent SQL injection

    try {
        // Create an instance of the UserManager class
        $userManager = new UserManager($conn);

        // Call the deleteUser method
        $userManager->deleteUser($userId);
    } catch (Exception $e) {
        // Handle exceptions (e.g., log errors, display user-friendly messages)
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
