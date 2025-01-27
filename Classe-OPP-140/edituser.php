<?php
// Include database connection file
require 'config.php'; // Adjust the path as needed

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
// ?>

// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Edit User</title>
// </head>
// <body>
//     <h2>Edit User</h2>
//     <form method='POST'>
//         <input type='hidden' name='user_id' value='<?php echo htmlspecialchars($idReceived); ?>'>
//         <label for='email'>Email:</label>
//         <input type='email' name='email' value='<?php echo htmlspecialchars($email); ?>' required>
//         <button type='submit' name='update_user'>Update User</button>
//     </form>
//     <a href='index.php'>Cancel</a>
// </body>
// </html>
