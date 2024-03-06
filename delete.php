<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223khushpreet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM tbl_user WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record with ID $id deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No 'id' parameter provided.";
}

$conn->close();
?>