<?php

session_start();
$table = $_SESSION['table'];
// Check if the SBN_NO parameter is set and not empty
if (isset($_POST['SBN_NO']) && !empty($_POST['SBN_NO'])) {
    // Include your database connection file
    include 'connection.php';

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM $table WHERE SBN_NO = ?");
    $stmt->bind_param("s", $_POST['SBN_NO']);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Return a success message or any necessary response
    echo "Record deleted successfully";
} else {
    // Return an error message or handle the case where SBN_NO parameter is missing
    echo "Error: SBN_NO parameter is missing or empty";
}
?>
