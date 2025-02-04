<?php
// fetch-services.php

require_once 'Controllers/UserController.php';  // Include the UserController
require_once 'Models/Database.php';  // Include the database connection



try {
    $database = new Database(__DIR__ . '/../');
    $conn = $database->getConnection();
    $serviceController = new ServiceHandler($conn);

    $searchTerm = $_GET['search'] ?? '';

    // Fetch filtered services
    $services = $serviceController->searchServices($searchTerm);

    // Generate HTML for the filtered services
    $html = '';
    foreach ($services as $row) {
        $html .= "<tr>
            <td>" . htmlspecialchars($row['id'] ?? '') . "</td>
            <td>" . htmlspecialchars($row['name'] ?? '') . "</td>
            <td class='description-cell' onclick='showFullDescription(\"" . htmlspecialchars($row['description'] ?? '') . "\")'>" . htmlspecialchars($row['description'] ?? '') . "</td>
            <td>" . htmlspecialchars($row['price'] ?? '') . "</td>
            <td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>
            <td>" . htmlspecialchars($row['updated_at'] ?? '') . "</td>
            <td>
                <form method='POST' action='delete.php' style='display:inline;'>
                    <input type='hidden' name='service_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                    <button type='submit' onclick='return confirm(\"Are you sure you want to delete this service?\");'>Delete</button>
                </form>
                <form method='GET' action='perfil-update.php' style='display:inline;'>
                    <input type='hidden' name='service_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                    <button type='submit'>Edit</button>
                </form>
            </td>
        </tr>";
    }

    echo $html;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>