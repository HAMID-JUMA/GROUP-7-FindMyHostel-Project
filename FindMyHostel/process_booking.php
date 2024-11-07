<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management_system";

// Establishing a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$hostel_id = $_POST['hostel_id'];
$user_id = $_POST['user_id']; // Make sure you are passing this in the form
$room_type = $_POST['room_type'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$number_of_guests = $_POST['number_of_guests'];

// Prepare SQL to insert a new booking with status 'pending'
$sql = "INSERT INTO bookings (hostel_id, user_id, room_type, check_in, check_out, number_of_guests, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissssi", $hostel_id, $user_id, $room_type, $check_in, $check_out, $number_of_guests);

if ($stmt->execute()) {
    // Redirect to the booking page (or wherever you want)
    header("Location: Booking.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
