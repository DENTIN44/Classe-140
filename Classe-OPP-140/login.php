
<?php
require_once 'Models/Database.php';  // Include the database connection
require_once 'Controllers/UserRegistration.php';  // Include the UserRegistration controller
require_once 'Controllers/UserController.php';  // Include the UserController

// Handle form submission for user registration
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Create an instance of RegisterController and register the user
    $registerController = new RegisterController($conn);
    $registerController->handleRegistration($email, $password);
}

// var_dump($_ENV);


// $userController = new UserController($conn);
// $users = $userController->index();  
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
    <form action="register.php" method="POST">
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
            </tr>
        </thead>
        <tbody>


