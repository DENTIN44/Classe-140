<?php

require_once 'register.php';  // Make sure this file includes the UserRegistration class

class RegisterController {
    private $userRegistration;

    public function __construct($conn) {
        // Instantiate the UserRegistration model with the database connection
        $this->userRegistration = new UserRegistration($conn);
    }

    // Method to handle user registration
    public function handleRegistration($email, $password) {
        try {
            // Validate the email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format.");
            }

            // Validate the password (e.g., minimum length)
            if (strlen($password) < 6) {
                throw new Exception("Password must be at least 6 characters long.");
            }

            // Call the registerUser method from the UserRegistration model
            $this->userRegistration->registerUser($email, $password);

            // Optionally, redirect to a success page
            header("Location: success.php");
            exit;
        } catch (Exception $e) {
            // Catch and handle exceptions if any occur during registration
            echo "Error: " . $e->getMessage();
        }
    }
}

