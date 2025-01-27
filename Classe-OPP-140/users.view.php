<?php
        // Loop through the $users array and display each user's data in a table row
        foreach ($users as $row) {
            echo "<tr>
                <td>" . htmlspecialchars($row['id'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['email'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['password'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['resetPasswordToken'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['resetPasswordExpires'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['createdAt'] ?? '') . "</td>
                <td>" . htmlspecialchars($row['updatedAt'] ?? '') . "</td>
                <td>
                    <!-- Form to delete the user -->
                    <form method='POST' action='delete.php' style='display:inline;'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</button>
                    </form>
                    <!-- Form to edit the user -->
                    <form method='GET' action='edituser.php' style='display:inline;'>
                        <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>
                        <button type='submit'>Edit</button>
                    </form>
                </td>
            </tr>";
        }