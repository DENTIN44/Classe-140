<?php
require_once 'Models/Database.php';

// Define a class to handle user registration
class UserRegistration {
    private $conn; // Private property to hold the database connection

    // Constructor to initialize the database connection
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to register a new user
    public function registerUser($email, $password) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$this->conn) {
            die("Database connection not established.");
        }

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO Users (email, password) VALUES (?, ?)");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ss", $email, $hashedPassword);

        // Execute the statement and check for success
        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();

        // Redirect after successful registration
        header("Location: index.php");
        exit; // Ensure the script stops after redirect
    }
}

// Usage example
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Get the email and password from the form
//     $email = isset($_POST['email']) ? trim($_POST['email']) : '';
//     $password = isset($_POST['password']) ? $_POST['password'] : '';

//     try {
//         // Create an instance of the UserRegistration class
//         $userRegistration = new UserRegistration($conn);

//         // Register the user
//         $userRegistration->registerUser($email, $password);
//     } catch (Exception $e) {
//         // Handle exceptions (e.g., log errors, display user-friendly messages, etc.)
//         echo "Error: " . $e->getMessage();
//     }
// }

// Close the database connection if it exists
if (isset($conn) && $conn !== null) {
    $conn->close();
}

?>
