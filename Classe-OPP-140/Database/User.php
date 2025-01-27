<?php
require 'Database.php'; // Include the database connection file

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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the email and password from the form
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        // Create an instance of the UserRegistration class
        $userRegistration = new UserRegistration($conn);

        // Register the user
        $userRegistration->registerUser($email, $password);
    } catch (Exception $e) {
        // Handle exceptions (e.g., log errors, display user-friendly messages, etc.)
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn->close();

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

// User class to handle user-related operations
class User {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Fetch user by ID
    public function fetchUser($userId) {
        $sql = "SELECT * FROM Users WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null; // Return null if no user found
            }
        } else {
            throw new Exception("Error preparing the statement: " . $this->conn->error);
        }
    }

    // Update user by ID
    public function updateUser($userId, $email) {
        $sql = "UPDATE Users SET email = ? WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("si", $email, $userId);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error executing the query: " . $stmt->error);
            }
        } else {
            throw new Exception("Error preparing the statement: " . $this->conn->error);
        }
    }
}

// Main logic
try {
    $userHandler = new User($conn); // Pass the database connection to the User class
    $email = '';
    $idReceived = 0;

    if (isset($_GET['user_id'])) {
        $idReceived = intval($_GET['user_id']);
        $user = $userHandler->fetchUser($idReceived);

        if ($user) {
            $email = $user['email'];
        } else {
            echo "User not found.";
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
        $userId = intval($_POST['user_id']);
        $email = $_POST['email'];

        if ($userHandler->updateUser($userId, $email)) {
            header('Location: index.php');
            exit;
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();

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