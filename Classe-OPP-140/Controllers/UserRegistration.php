<?php

require_once 'UserController.php';  // Make sure this file includes the UserRegistration class

class RegisterController {
    private $userRegistration;

    public function __construct($conn) {
        // Instantiate the UserRegistration model with the database connection
        $this->userRegistration = new UserRegistration($conn);
    }

    // Method to handle user registration
    public function handleRegistration($email, $password) {
        try {
            // Call the registerUser method from the UserRegistration model
            $this->userRegistration->registerUser($email, $password);
        } catch (Exception $e) {
            // Catch and handle exceptions if any occur during registration
            echo "Error: " . $e->getMessage();
        }
    }
}
