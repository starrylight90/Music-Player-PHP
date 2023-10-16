<?php
session_start();
require_once "connection.php";


if (!$conn) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}

// Handle form submissions for adding users
if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Validate and sanitize user input here
    // Insert the user into the 'user' table
    $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = $mysqli->query($query);
    if ($result) {
        echo 'User added successfully.';
    } else {
        echo 'Error adding user: ' . $mysqli->error;
    }
}

// Handle form submissions for deleting users
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    // Validate user input here
    // Delete the user from the 'user' table
    $query = "DELETE FROM user WHERE userid = $user_id";
    $result = $mysqli->query($query);
    if ($result) {
        echo 'User deleted successfully.';
    } else {
        echo 'Error deleting user: ' . $mysqli->error;
    }
}

// Fetch user data for display
$sql = "SELECT * FROM user";

$result = mysqli_query($conn, $sql);



echo "<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Add User Form -->
    <h2>Add User</h2>
    <form method='post' action='admin.php'>
        <input type='text' name='name' placeholder='Name' required>
        <input type='email' name='email' placeholder='Email' required>
        <input type='password' name='password' placeholder='Password' required>
        <button type='submit' name='add_user'>Add User</button>
    </form>

    <!-- Delete User Form -->
    <h2>Delete User</h2>
    <form method='post' action='admin.php'>
        <input type='number' name='user_id' placeholder='User ID' required>
        <button type='submit' name='delete_user'>Delete User</button>
    </form>

    <!-- Display Users -->
    <h2>Users</h2>
    <table border='2'>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Address</th>
        </tr>";
       while ($row = mysqli_fetch_assoc($result)) {
                            $name= $row['name'];
                            $email = $row['email'];
                            $dob = $row['Dob'];
                            $gender = $row['gender'];
                            $address = $row['address'];
                            echo "<tr><td>$name</td><td>$email</td><td>$dob</td><td>$gender</td><td>$address</td></tr>";
                        }
                        echo "</tbody>
                        </table>";
                        echo "<br>"; 
    echo "</table>

</body>
</html>";
// Close the database connection
mysqli_close($conn);
?>

