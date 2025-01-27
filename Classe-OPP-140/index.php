<?php
// Import the file that fetches users from the database
// require 'Controllers/UserController.php';


// Include the footer file
require 'header.php';
?>

<!-- $userController = new UserController($conn);
$users = $userController->index(); -->

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Reset Token</th>
            <th>Reset Expires</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>



<?php
// Include the footer file
require 'footer.php';
?>
