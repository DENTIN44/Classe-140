<?php
require_once 'Models/Database.php';  // Include the database connection
require_once 'Controllers/UserController.php';  // Include the UserController

try {
    // Instantiate the Database class with the correct path to the .env file
    $database = new Database(__DIR__ . '/../');  // Update to use the root directory
    $conn = $database->getConnection();  // Get the connection
    
    // Create the database if it doesn't exist
    // $database->createDatabase();

    // Create tables if they don't exist (ensure this method is defined in Database.php)
    $database->createTables();

    // Check the connection (you can enable this for debugging purposes)
    var_dump($conn);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Create a new instance of the UserRegistration class
$userRegistration = new UserRegistration($conn);

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Register the user
        $userRegistration->registerUser($email, $password);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Table</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h2>Register User</h2>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Register">
    </form>

    <h2>Latest Registered Users</h2>
    <table>
        <thead>
            <tr>
                <!-- You can add headers like "ID", "Email", etc. -->
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>resetPasswordToken</th>
                <th>resetPasswordExpires</th>
                <th>createdAt</th>
                <th>updatedAt</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through users to display them -->
            <?php
            $userController = new UserController($conn);
            $users = $userController->index(); // Fetch all users
            
              // Loop through the $users array and display each user's data in a table row
        foreach ($users as $row) {
            echo "<tr>
                <td>" . htmlspecialchars($row['id'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['email'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['password'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['resetPasswordToken'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['resetPasswordExpires'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['createdAt'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['updatedAt'] ?? '') . "</td>
                <td>
                    <!-- Form to delete the user -->
                    <form method='POST' action='delete.php' style='display:inline;'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</button>
                    </form>
                    <!-- Form to edit the user -->
                    <form method='GET' action='edituser.php' style='display:inline;'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit'>Edit</button>
                    </form>
                </td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
