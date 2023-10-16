<?php
session_start();
require_once "connection.php";


if (!$conn) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}


// Define the user ID you want to retrieve data for
$userID = 1;

// Build the SQL query to fetch user data
$sql = "SELECT * FROM user WHERE userid = $userID";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch user data from the result
        $user = mysqli_fetch_assoc($result);

        // Now, you can access user data as $user['column_name']
        $username = $user['name'];
        $email = $user['email'];
        $Dob = $user['Dob'];
        $Gender = $user['gender'];

        // You can use this data in your HTML to display user information
        echo "Username: $username<br>";
        echo "Email: $email<br>";
        echo "First Name: $Dob<br>";
        echo "Last Name: $Gender<br>";
    } else {
        echo "No user found with the provided user ID.";
    }
} else {
    echo "Error executing the SQL query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
