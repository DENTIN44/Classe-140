
<?php
require_once 'Models/Database.php';  // Include the controller
require_once 'Controllers/UserRegistration.php';  // Include the controller

$registerController = new RegisterController($conn);
$registerController->handleRegistration($email, $password);
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


