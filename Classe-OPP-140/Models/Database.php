<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

class Database {
    private $conn; // Database connection instance

    // Constructor to initialize the database connection
    public function __construct($envPath) {
        $this->loadEnvironment($envPath); // Load environment variables
        $this->connect(); // Establish the database connection
    }
    
    private function connect() {
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];
    
        try {
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            // echo "Successfully connected to the database!";
        } catch (mysqli_sql_exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to check if the connection exists
    public function isConnected() {
        if ($this->conn && $this->conn->ping()) {
            return true; // The connection is alive
        }
        return false; // The connection is not alive or does not exist
    }


    //Método para recuperar a instância da conexão
    public function getConnection() {
        return $this->conn;
    }

    private function loadEnvironment($path) {
        // Set the path to the root directory (one level up from the Models directory)
        $path = realpath(__DIR__ . '/../');  // Use realpath to get the absolute path
        
        $envFilePath = $path . '/.env';  // Correct path to .env file
        
        // Output the full path to the .env file
        // echo "Loading environment from: " . $envFilePath . "<br>";
    
        // Check if the .env file exists using the correct variable
        // if (file_exists($envFilePath)) {
        //     echo 'Found the .env file!<br>';
        // } else {
        //     echo 'Could not find the .env file.<br>';
        // }
    
        // Load environment variables from .env file
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
    
        // Debug output of environment variables
        // echo 'DB_HOST: ' . $_ENV['DB_HOST'] . '<br>';
        // echo 'DB_USERNAME: ' . $_ENV['DB_USERNAME'] . '<br>';
        // echo 'DB_DATABASE: ' . $_ENV['DB_DATABASE'] . '<br>';
    
        // Debug: verifica todas as variáveis ​​carregadas
        // echo "Environment variables loaded now:<br>";
        // foreach ($_ENV as $key => $value) {
        // echo "$key: $value<br>";
        // }

        // echo 'Dotenv loaded: ' . getenv('DB_HOST') . '<br>';
        // echo 'DB_HOST from $_ENV: ' . $_ENV['DB_HOST'] . '<br>';
        // echo 'DB_USER from getenv: ' . getenv('DB_USER') . '<br>';

        //Depuração: verifique se as variáveis ​​de ambiente estão carregadas
        // echo "Environment variables loaded:<br>";
        // echo "DB_HOST: " . $_ENV['DB_HOST'] . "<br>";
        // echo "DB_USER: " . $_ENV['DB_USER'] . "<br>";
        // echo "DB_PASS: " . $_ENV['DB_PASS'] . "<br>";
        // echo "DB_DATA: " . $_ENV['DB_DATA'] . "<br>";
    }

    // public function createDatabase() {
    //     $servername = $_ENV['DB_HOST'];  
    //     $username = $_ENV['DB_USERNAME'];    
    //     $password = $_ENV['DB_PASSWORD']; 
    //     $dbname = $_ENV['DB_DATABASE'];
    
    //     // Step 1: Connect without selecting the database (because it doesn't exist yet)
    //     $this->conn = new mysqli($servername, $username, $password);
    //     if ($this->conn->connect_error) {
    //         die("Connection failed: " . $this->conn->connect_error);
    //     } else {
    //         echo "Connection successful.<br>";
    //     }
    
    //     // Step 2: Check if the database exists, if not, create it
    //     $sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
    
    //     echo "Executing SQL query: $sql<br>";
    
    //     if ($this->conn->query($sql) === TRUE) {
    //         echo "Database created successfully or already exists.<br>";
    //     } else {
    //         echo "Error creating database: " . $this->conn->error . "<br>";
    //         echo "SQL: $sql<br>";
    //         return;  // Exit if there was an error creating the database
    //     }
    
    //     // Step 3: Select the newly created database explicitly
    //     if ($this->conn->select_db($dbname)) {
    //         echo "Successfully selected the database: " . $dbname . "<br>";
    //     } else {
    //         echo "Error selecting the database: " . $this->conn->error . "<br>";
    //         return;  // Exit if there was an error selecting the database
    //     }
    
    //     // Step 4: Confirm connection to the specific database
    //     if ($this->conn->ping()) {
    //         echo "Ping successful. The database connection is active.<br>";
    //     } else {
    //         throw new Exception("Error connecting to the database: " . $this->conn->error);
    //     }
    // }
    
    

    public function createTables() {
        // Check if the connection is null and if it's open
        if ($this->conn === null || !$this->conn->ping()) {
            throw new Exception("Database connection not established or is closed.");
        }
    
        $sql = "CREATE TABLE IF NOT EXISTS Users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    resetPasswordToken VARCHAR(255) DEFAULT NULL,
                    resetPasswordExpires DATETIME DEFAULT NULL,
                    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
    
        // Check if query execution was successful
        if ($this->conn->query($sql) === TRUE) {
            // echo "Table 'Users' created successfully or already exists.<br>";
        } else {
            throw new Exception("Error creating table: " . $this->conn->error);
        }
    }
    
    public function __destruct() {
        // Only close the connection if it's alive
        if ($this->conn && $this->conn->ping()) {
            $this->conn->close();
        }
    }
    
    
}

// Usage
$database = new Database(__DIR__ . '/../.env');  // This goes up one level to the root where the .env file is
if ($database->isConnected()) {
    // echo "Connection is successful and alive.";
} else {
    // echo "Connection failed or is no longer alive.";
}

?>
