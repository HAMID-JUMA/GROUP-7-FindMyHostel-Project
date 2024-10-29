<?php
// Database connection (update with your credentials)
$dsn = "mysql:host=localhost;dbname=hostel_management_system;charset=utf8mb4"; // Data Source Name
$username = "root"; // Database username
$password = ""; // Database password

try {
    // Create a new PDO instance
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage()); // Handle connection errors
}

// Fetch hostel details
$id = 1; // Assuming you want to fetch the hostel with ID 1 (you may want to adjust this)
$sql = "SELECT * FROM hostels WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$hostel = $stmt->fetch(PDO::FETCH_ASSOC); // Get the hostel details

// Check if the hostel details were fetched successfully
if (!$hostel) {
    die("Hostel not found."); // Handle the case where no hostel was found
}

// Update hostel details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $hostel_name = $_POST['hostel_name'];
    $owner_name = $_POST['owner_name'];
    $distance = $_POST['distance'];
    $contact = $_POST['contact'];
    $price = $_POST['price'];
    $hostel_image = $hostel['hostel_image']; // Default to current image if not updated

    // Check if a new image is uploaded
    if (!empty($_FILES['hostel_image']['name'])) {
        // Set the directory for uploaded images
        $target_dir = "uploads/";
        $hostel_image = $target_dir . basename($_FILES["hostel_image"]["name"]);
        
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES["hostel_image"]["tmp_name"], $hostel_image);
    }

    // Prepare and execute the update query
    $update_sql = "UPDATE hostels SET hostel_name = :hostel_name, owner_name = :owner_name, distance = :distance, contact = :contact, price = :price, hostel_image = :hostel_image WHERE id = :id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(':hostel_name', $hostel_name);
    $update_stmt->bindParam(':owner_name', $owner_name);
    $update_stmt->bindParam(':distance', $distance);
    $update_stmt->bindParam(':contact', $contact);
    $update_stmt->bindParam(':price', $price);
    $update_stmt->bindParam(':hostel_image', $hostel_image);
    $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the update and check for success
    if ($update_stmt->execute()) {
        echo "<script>alert('Hostel details updated successfully!');</script>";
        header("Location: hostels-management.php"); // Reload to fetch updated details
        exit();
    } else {
        echo "Error updating record."; // Display error if update fails
    }
}

$conn = null; // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Hostel Details</title>
    <style>
        /* Basic styles for the body */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .hostel-details {
            margin-bottom: 20px; /* Spacing below hostel details */
        }
        .popup {
            display: none; /* Hidden by default */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: white; /* Background for popup content */
            padding: 20px; /* Spacing within the popup */
            border-radius: 5px;
            width: 300px; /* Width of the popup */
        }
        .close {
            cursor: pointer; /* Pointer cursor for close button */
            color: red; /* Color for close button */
            float: right; /* Position close button to the right */
        }
        #updateButton {
            padding: 10px 15px; /* Padding for the update button */
            background-color: #007BFF; /* Button background color */
            color: white; /* Button text color */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor for button */
        }
        #updateButton:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        img {
            width: 150px; /* Image width */
            height: 150px; /* Image height */
            margin-top: 10px; /* Space above the image */
        }
    </style>
    <script>
        // Function to open the popup
        function openPopup() {
            document.getElementById("popup").style.display = "flex"; // Display popup
        }

        // Function to close the popup
        function closePopup() {
            document.getElementById("popup").style.display = "none"; // Hide popup
        }
    </script>
</head>
<body>
    <h1>Hostel Details</h1>
    <div class="hostel-details">
        <strong>Hostel Name:</strong> <?php echo htmlspecialchars($hostel['hostel_name']); ?><br>
        <strong>Owner Name:</strong> <?php echo htmlspecialchars($hostel['owner_name']); ?><br>
        <strong>Distance:</strong> <?php echo htmlspecialchars($hostel['distance']); ?> km<br>
        <strong>Contact:</strong> <?php echo htmlspecialchars($hostel['contact']); ?><br>
        <strong>Price:</strong> $<?php echo htmlspecialchars($hostel['price']); ?><br>
        <?php if ($hostel['hostel_image']): ?>
            <strong>Hostel Image:</strong><br>
            <img src="<?php echo htmlspecialchars($hostel['hostel_image']); ?>" alt="Hostel Image">
        <?php endif; ?>
        <button id="updateButton" onclick="openPopup()">Update Details</button> <!-- Button to open the form -->
    </div>

    <!-- Popup for updating hostel details -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">✖</span> <!-- Close button -->
            <h2>Update Hostel Details</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="hostel_name">Hostel Name:</label>
                <input type="text" name="hostel_name" id="hostel_name" value="<?php echo htmlspecialchars($hostel['hostel_name']); ?>" required><br>

                <label for="owner_name">Owner Name:</label>
                <input type="text" name="owner_name" id="owner_name" value="<?php echo htmlspecialchars($hostel['owner_name']); ?>" required><br>

                <label for="distance">Distance (in km):</label>
                <input type="number" name="distance" id="distance" step="0.1" value="<?php echo htmlspecialchars($hostel['distance']); ?>" required><br>

                <label for="contact">Contact:</label>
                <input type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($hostel['contact']); ?>" required><br>

                <label for="price">Price:</label>
                <input type="number" name="price" id="price" step="0.01" value="<?php echo htmlspecialchars($hostel['price']); ?>" required><br>

                <label for="hostel_image">Hostel Image:</label><br>
                <input type="file" name="hostel_image" id="hostel_image" accept="image/*"><br>

                <input type="submit" value="Update"> <!-- Submit button for the form -->
            </form>
        </div>
    </div>
</body>
</html>
