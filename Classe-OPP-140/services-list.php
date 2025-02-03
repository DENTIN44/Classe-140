<?php
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

?>

<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            overflow-x: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            color: #444;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            height: auto;
            border-collapse: collapse;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background: orangered;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f9c4a6;
        }

        th {
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            
        }

        button {
            background-color: orangered;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        button:hover {
            background-color: darkred;
        }

        td form {
            display: inline;
        }

        td {
            vertical-align: middle;
        }

        tbody tr td:nth-child(3) {
            display: -webkit-box;
            max-width: 100px;
            height: 20px; /* Limit the height to control the number of visible lines */
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            -webkit-line-clamp: 2;
            line-height: 1.2; /* Adjust line height for better spacing */
            -webkit-box-orient: vertical;
        }

        /* Full Description Modal */
        #descriptionModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 1000;
            max-width: 400px;
            max-height: 300px;
            overflow-y: auto;
            border-radius: 8px;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }

    </style>

<!-- Search form for services -->
<input type="text" id="search-input" placeholder="Search for a service..." />

<!-- Displaying results -->
<div id="services-list"></div>
<div class="form-group">
<a href="index.php">Back to Home</a>
</div>

<h2>Latest Registered Services</h2>
    <table>
        <thead>
            <tr>
                <!-- You can add headers like "ID", "Email", etc. -->
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Actions</th> <!-- Explicit header for the buttons -->
            </tr>
        </thead>
        <tbody>
            <!-- Loop through users to display them -->
            <?php
            $serviceController = new ServiceController($conn);
            $services = $serviceController->index(); 
            
              // Loop through the $users array and display each user's data in a table row
        foreach ($services as $row) {
            echo "<tr>
                <td>" . htmlspecialchars($row['id'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['name'] ?? '') . "</td>
                <td class='description-cell' onclick='showFullDescription(\"" . htmlspecialchars($row['description'] ?? '') . "\")'>" . htmlspecialchars($row['description'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['price'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['updated_at'] ?? '') . "</td>
                <td>
                    <!-- Form to delete the user -->
                    <form method='POST' action='delete.php' style='display:inline;'>
                        <input type='hidden' name='service_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</button>
                    </form>
                    <!-- Form to edit the user -->
                    <form method='GET' action='perfil-update.php' style='display:inline;'>
                        <input type='hidden' name='service_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit'>Edit</button>
                    </form>
                </td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
    
    <div id="overlay" onclick="closeModal()"></div>
    <div id="descriptionModal"></div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showFullDescription(description) {
            const modal = document.getElementById('descriptionModal');
            const overlay = document.getElementById('overlay');
            
            modal.textContent = description;
            modal.style.display = 'block';
            overlay.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('descriptionModal').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var searchTerm = $(this).val();

            // Make AJAX request to the server with the search term
            $.ajax({
                url: 'your-php-file.php', // Replace with your PHP file
                method: 'GET',
                data: { search: searchTerm },
                success: function(response) {
                    // Display the filtered services
                    $('#services-list').html(response);
                }
            });
        });
    });

    </script>