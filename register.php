<?php
// Include the database connection
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $address = $_POST['Address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // Check if the username already exists
    $check_username = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another one.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (name, username, address, password) VALUES ('$name', '$username', '$address', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! You can now <a href='login.html'>log in</a>.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
