<?php
// Include Composer's autoloader
require __DIR__ . '/vendor/autoload.php';  // Ensure this path is correct

use Dotenv\Dotenv;

// Specify the exact path to the .env file
// $dotenv = Dotenv::createImmutable('(__DIR__)');

// Check if the .env file exists
// if (!file_exists('/home/felix/Desktop/Classe-OPP-140/.env')) {
//     die("Error: .env file not found.");
// }

// Load the environment variables
// $dotenv->load();

class Database {
    private $conn; // Database connection instance

    // Constructor to initialize the database connection
    public function __construct($envPath) {
        $this->loadEnvironment($envPath); // Load environment variables
        $this->connect(); // Establish the database connection
    }

    // Method to load environment variables
    private function loadEnvironment($path) {
        if (!file_exists($path . '/.env')) {
            throw new Exception("Error: .env file not found in the specified path");
        }
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
    
        // Debugging: Print environment variables
        echo "Environment variables loaded:<br>";
        echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
        echo "DB_USERNAME: " . getenv('DB_USERNAME') . "<br>";
        echo "DB_PASSWORD: " . getenv('DB_PASSWORD') . "<br>";
        echo "DB_DATABASE: " . getenv('DB_DATABASE') . "<br>";
    }
    
    private function connect() {
        $servername = getenv('DB_HOST');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');
    
        echo "Connecting with username: $username<br>";
    
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to create the database if it does not exist
    public function createDatabase() {
        $servername = getenv('DB_HOST');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        
        // Establish connection without selecting the database to create it
        $conn = new mysqli($servername, $username, $password);
        
        // Check the connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE DATABASE IF NOT EXISTS " . getenv('DB_DATABASE');
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully or already exists.<br>";
        } else {
            throw new Exception("Error creating database: " . $conn->error);
        }

        // Close the connection after creating the database
        $conn->close();
    }

    // Method to create the necessary tables
    public function createTables() {
        // Use the connection instance with the database selected
        $conn = $this->conn;

        $sql = "CREATE TABLE IF NOT EXISTS Users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'Users' created successfully or already exists.<br>";
        } else {
            throw new Exception("Error creating table: " . $conn->error);
        }
    }

    // Method to retrieve the connection instance
    public function getConnection() {
        return $this->conn;
    }

    // Destructor to close the connection when the object is destroyed
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Usage Example
try {
    // Instantiate the Database class with the path to the .env file
    $database = new Database(__DIR__);
    $conn = $database->getConnection();
    
    // Create the database if it doesn't exist
    $database->createDatabase();

    // Create the tables if they don't exist
    $database->createTables();

    // Debugging: Uncomment to verify the connection
    // var_dump($conn);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
