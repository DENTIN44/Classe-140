<?php

require __DIR__ . '/vendor/autoload.php';  
use Dotenv\Dotenv;

class Database {
    private $conn; // Database connection instance

    //Construtor para inicializar a conexão com o banco de dados
    public function __construct($envPath) {
        $this->loadEnvironment($envPath); // Load environment variables
        $this->connect(); // Establish the database connection
    }

    private function loadEnvironment($path) {

        // echo "Loading environment from: " . $path . '/.env' . "<br>";

        if (!file_exists($path . '/.env')) {
            throw new Exception("Error: .env file not found in the specified path");
        }

        // $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv = Dotenv::createImmutable($path);
        // echo "Dotenv instance created<br>";

        $dotenv->load();

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
    
    
    private function connect() {
        $servername = $_ENV['DB_HOST'];  
        $username = $_ENV['DB_USER'];    
        $password = $_ENV['DB_PASS'];   
        $dbname = $_ENV['DB_DATA'];     
    
        // echo "Connecting with username named: $username<br>";
    
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createDatabase() {
        $servername = $_ENV['DB_HOST'];  
        $username = $_ENV['DB_USER'];    
        $password = $_ENV['DB_PASS'];   
        
        // Estabelece conexão sem selecionar o banco de dados para criá-la
        $conn = new mysqli($servername, $username, $password);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "CREATE DATABASE IF NOT EXISTS " . $_ENV['DB_DATA'];
    
        // echo "Executing SQL query: $sql<br>";
    
        if ($conn->query($sql) === TRUE) {
            // echo "Database created successfully or already exists.<br>";
        } else {
            throw new Exception("Error creating database: " . $conn->error);
        }
    
        $conn->close();
    }
    

    public function createTables() {
        
        //Utiliza a instância de conexão com o banco de dados selecionado
        $conn = $this->conn;

        $sql = "CREATE TABLE IF NOT EXISTS Users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";

        if ($conn->query($sql) === TRUE) {
            // echo "Table 'Users' created successfully or already exists.<br>";
        } else {
            throw new Exception("Error creating table: " . $conn->error);
        }
    }

    //Método para recuperar a instância da conexão
    public function getConnection() {
        return $this->conn;
    }

    // Destruidor para fechar a conexão quando o objeto for destruído
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

try {
    
    // Instancia a classe Database com o caminho para o arquivo .env
    $database = new Database(__DIR__);
    $conn = $database->getConnection();
    
    // Cria o banco de dados se ele não existir
    $database->createDatabase();

    // Cria as tabelas se elas não existirem
    $database->createTables();

    // Depuração: remova o comentário para verificar a conexão
    // var_dump($conn);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
