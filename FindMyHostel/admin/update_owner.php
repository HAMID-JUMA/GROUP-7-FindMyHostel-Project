<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed']));
}

$id = $data['id'];
$ownerName = $data['ownerName'];
$contact = $data['contact'];
$hostelName = $data['hostelName'];
$distance = $data['distance'];

$sql = "UPDATE hostels SET owner_name='$ownerName', contact='$contact', hostel_name='$hostelName', distance='$distance' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Update failed']);
}

$conn->close();
?>
