<?php
session_start();
include("connection.php");

function authenticateUser($username, $password, $conn) {
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user from the database
    $query = "SELECT * FROM adminAccount WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if ($password == $user['password']) {
            // Password matches, set session variable to indicate authentication
            $_SESSION['authenticated'] = true;
            // Optionally, you can store additional user data in the session
            $_SESSION['user'] = $user;
            return true;
        }
    }
    // User not found or password doesn't match
    return false;
}

// Check if user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // User is already authenticated, redirect to adminDashboard.php or other authorized pages
    echo '<script>
            alert("You are already logged in!");
            window.location.href="adminDashboard.php";
            </script>';
            exit();
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to authenticate user
    if (authenticateUser($username, $password, $conn)) {
        // Authentication successful, redirect to adminDashboard.php
        echo '<script>
            alert("You are already logged in!");
            window.location.href="adminDashboard.php";
            </script>';
            exit();
    } else {
        // Authentication failed, display error message or redirect back to login page
        echo "Invalid username or password.";
    }
}
?>
