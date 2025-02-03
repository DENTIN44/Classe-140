<?php
require_once 'Models/User.php';


class ServiceController {
    private $serviceHandler;

    public function __construct($conn) {
        $this->serviceHandler = new ServiceHandler($conn);
    }

    public function index() {
        return $this->serviceHandler->fetchservices();
    }
}

class RegisterController {
    private $serviceRegistration;

    public function __construct($conn) {
        // Instantiate the ServiceRegistration model with the database connection
        $this->serviceRegistration = new ServiceRegistration($conn);
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
            $this->serviceRegistration->registerService($email, $password);

            // Optionally, redirect to a success page
            header("Location: register.php");
            exit;
        } catch (Exception $e) {
            // Catch and handle exceptions if any occur during registration
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
