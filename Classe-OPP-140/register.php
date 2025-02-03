<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


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
    // var_dump($conn);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Create a new instance of the ServiceRegistration class
$serviceRegistration = new ServiceRegistration($conn);

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    try {
        // Register the service
        $serviceRegistration->registerService($name, $description, $price);
    } catch (Exception $e) {
        // Display error message if something goes wrong
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Service</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            overflow-x: auto;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto; /* Add auto margin */
        }


        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #FF5722;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group span {
            font-size: 14px;
            color: red;
        }

        .form-group button {
            background-color: #FF5722;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #E64A19;
        }

        .form-group a {
            text-align: center;
            color: #007BFF;
            margin-top: 20px;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        /* Flash Message Styles */
        .alert {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 600px;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
            display: none;
            margin-top: 20px; /* Optional to add space between alert and top */
        }


        .alert-success {
            background-color: #4CAF50;
            color: white;
        }

        .alert-danger {
            background-color: #f44336;
            color: white;
        }

        .alert button {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
        }}

    </style>
</head>
<body>

            <div class="form-group">
                <a href="index.php">Back to Home</a>
            </div>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div id="flash-success" class="alert alert-success">
            <button onclick="closeAlert('flash-success')">×</button>
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div id="flash-error" class="alert alert-danger">
            <button onclick="closeAlert('flash-error')">×</button>
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>Register Service</h2>
        <form method="post" action="register.php">
            <?php
            session_start();

            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }

            function old($key) {
                return $_SESSION['old'][$key] ?? '';
            }

            function error($key) {
                return $_SESSION['errors'][$key] ?? null;
            }
            ?>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="form-group">
                <label for="name">Service Name<span>*</span></label>
                <input type="text" name="name" required value="<?php echo old('name'); ?>">
                <?php if ($error = error('name')): ?>
                    <span><?php echo $error; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Description<span>*</span></label>
                <input type="text" name="description" required value="<?php echo old('description'); ?>">
                <?php if ($error = error('description')): ?>
                    <span><?php echo $error; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="price">Price<span>*</span></label>
                <input type="number" name="price" required value="<?php echo old('price'); ?>">
                <?php if ($error = error('price')): ?>
                    <span><?php echo $error; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button type="submit">Add Service</button>
            </div>

        </form>
    </div>

    <!-- Flash Message JavaScript -->
    <script>
        // Function to close the flash messages
        function closeAlert(id) {
            document.getElementById(id).style.display = 'none';
        }

        // Show flash success or error messages after form submission
        window.onload = function() {
            <?php if (isset($_SESSION['success'])): ?>
                document.getElementById('flash-success').style.display = 'block';
                setTimeout(() => { document.getElementById('flash-success').style.display = 'none'; }, 5000);
            <?php elseif (isset($_SESSION['error'])): ?>
                document.getElementById('flash-error').style.display = 'block';
                setTimeout(() => { document.getElementById('flash-error').style.display = 'none'; }, 5000);
            <?php endif; ?>
        };
    </script>

    <?php
    unset($_SESSION['errors'], $_SESSION['old']);
    ?>

</body>
</html>


