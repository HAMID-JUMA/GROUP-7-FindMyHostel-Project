<?php
session_start(); // Start the session

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management_system";

// Establishing a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the booking_id is set in the query parameters
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Prepare the delete query
    $sql = "DELETE FROM bookings WHERE booking_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            echo "<script>alert('Booking deleted successfully!'); window.location.href='students-management.php';</script>"; // Redirect back after deletion
        } else {
            echo "Error deleting booking: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing delete statement: " . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>
