<?php
    session_start();

    // Database connection setup
    $dsn = "mysql:host=localhost;dbname=hostel_management_system;charset=utf8mb4";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }
    $user_id = $_SESSION['user_id'];

    // Fetch the logged-in user's name from the users table
    $sql = "SELECT name FROM users WHERE user_id = :user_id"; // Adjusted to match 'id' as primary key in 'users' table
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $owner_name = $user['name'] ?? ''; // Set owner name if fetched, otherwise default to empty string

    // Create 'uploads/' directory if it doesn't exist
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle form submission for adding a new hostel
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_hostel'])) {
        $hostel_name = $_POST['hostel_name'];
        $distance = $_POST['distance'];
        $contact = $_POST['contact'];
        $price = $_POST['price'];
        $number_of_rooms = $_POST['number_of_rooms'];

        // Handle image upload
        $hostel_image = null;
        if (!empty($_FILES['hostel_image']['name'])) {
            $targetFile = $uploadDir . basename($_FILES['hostel_image']['name']);
            if (move_uploaded_file($_FILES['hostel_image']['tmp_name'], $targetFile)) {
                $hostel_image = $targetFile;
            } else {
                echo "Error: Could not upload file.";
            }
        }

        // Insert the new hostel into the database
        $sql = "INSERT INTO hostels (hostel_name, owner_name, distance, contact, price, hostel_image, owner_id, number_of_rooms) 
                VALUES (:hostel_name, :owner_name, :distance, :contact, :price, :hostel_image, :owner_id, :number_of_rooms)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':hostel_name', $hostel_name);
        $stmt->bindParam(':owner_name', $owner_name);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':hostel_image', $hostel_image);
        $stmt->bindParam(':owner_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':number_of_rooms', $number_of_rooms, PDO::PARAM_INT);
        $stmt->execute();

        echo "Hostel added successfully!";
    }

    // Handle form submission for updating hostel details
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hostel'])) {
        $hostel_name = $_POST['hostel_name'];
        $distance = $_POST['distance'];
        $contact = $_POST['contact'];
        $price = $_POST['price'];
        $number_of_rooms = $_POST['number_of_rooms'];

        // Check if a new image was uploaded, otherwise use existing
        $hostel_image = $_POST['existing_image'];
        if (!empty($_FILES['hostel_image']['name'])) {
            $targetFile = $uploadDir . basename($_FILES['hostel_image']['name']);
            if (move_uploaded_file($_FILES['hostel_image']['tmp_name'], $targetFile)) {
                $hostel_image = $targetFile;
            }
        }

        // Update the hostel details in the database
        $sql = "UPDATE hostels SET hostel_name = :hostel_name, distance = :distance, contact = :contact, 
                price = :price, hostel_image = :hostel_image, number_of_rooms = :number_of_rooms 
                WHERE owner_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':hostel_name', $hostel_name);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':hostel_image', $hostel_image);
        $stmt->bindParam(':number_of_rooms', $number_of_rooms, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Hostel details updated successfully!";
    }

    // Fetch hostel details based on the logged-in user
    $sql = "SELECT * FROM hostels WHERE owner_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $hostels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $hostel_not_found = empty($hostels);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding declaration to ensure correct display of characters -->
    <meta charset="UTF-8">
    <!-- Sets the viewport for responsive design on different devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the page displayed on the browser tab -->
    <title>FMH(Dashboard) - Admin Panel</title>
    <!-- Basic styling for sidebar layout -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic Styling */
        .hostel-details, .hostel-not-found { 
            margin-bottom: 20px; 
            padding: 15px; 
            border: 1px solid #ddd; 
            border-radius: 5px; }
        .popup { 
            padding-top: 30px;
            display: none; 
            position: fixed; 
            left: 0; top: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.7); 
            justify-content: center; 
            align-items: center; 
        }
        .popup-content { 
            background: white; 
            padding: 20px; 
            border-radius: 5px; 
            width: 300px; 
        }
        .close { 
            cursor: pointer; 
            color: red; 
            float: right; }
        #addButton, #updateButton, input[type="submit"] { 
            padding: 10px 15px; 
            background-color: #007BFF; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            margin-top: 10px; }
        #addButton:hover, #updateButton:hover, input[type="submit"]:hover { background-color: #0056b3; }
        input[type="text"], input[type="number"], input[type="file"] { 
            width: 100%; 
            padding: 8px; 
            margin: 5px 0; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
        }
        img { 
            width: 150px; 
            height: 150px; 
            margin-top: 10px; 
            border-radius: 5px; 
        }
    </style>
    <script>
        // JavaScript functions to open and close popups
        function openPopup(popupId) { document.getElementById(popupId).style.display = "flex"; }
        function closePopup(popupId) { document.getElementById(popupId).style.display = "none"; }
    </script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
            <div class="FMHlabel ">
            <h2>
                <img src="logo.jpeg" alt="Profile Picture" class="profile-pic"> <span class="label">FMH</span>
            </h2>
        </div>
        <div style="margin-top: 81px;">
            <ul>
                <li><a href="owner_dashboard.php" active><i class="fas fa-tachometer-alt"></i><span class="link-text">Dashboard</span></a></li>
                <li><a href="hostels-management.php"><i class="fas fa-building"></i><span class="link-text">Manage Hostel</span></a></li>
                <li><a href="students-management.php"><i class="fas fa-user-graduate"></i><span class="link-text">Manage Students</span></a></li>

            </ul>
        </div>
    </div>

    <!-- Top bar -->
    <div class="topbar" id="topbar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Find My Hostel - owner Panel</h2>

        <!-- User Dropdown with profile picture -->
        <div class="user-dropdown" style="position: absolute; right: 20px; top: 15px;">
            <button onclick="toggleDropdown()">
                <img src="logo.jpeg" alt="User Profile Picture"><?php echo $_SESSION['user_name']; ?>
            </button>
            <div class="user-dropdown-content">
                <a href="\fmh\user-profile.php"><i class="fas fa-user"></i>My Account</a>
                <a href="\fmh\login.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
       </div>
    </div>

    <!-- Main content area -->
    <div class="main-content" id="main-content">
    <div class="container">
        <?php if ($hostel_not_found): ?>
            <div class="hostel-not-found">
                <p>No hostels found for this user. <br>CREATE YOUR HOSTEL</p>
                <button id="addButton" onclick="openPopup('addPopup')">Add New Hostel</button>
            </div>
        <?php else: ?>
            <h1>Your Hostel</h1>
            <?php foreach ($hostels as $hostel): ?>
                <div class="hostel-details">
                    <strong>Hostel Name:</strong> <?php echo htmlspecialchars($hostel['hostel_name']); ?><br>
                    <strong>Owner Name:</strong> <?php echo htmlspecialchars($hostel['owner_name']); ?><br>
                    <strong>Distance:</strong> <?php echo htmlspecialchars($hostel['distance']); ?> km<br>
                    <strong>Contact:</strong> <?php echo htmlspecialchars($hostel['contact']); ?><br>
                    <strong>Price:</strong> MK<?php echo htmlspecialchars($hostel['price']); ?><br>
                    <strong>Number of Rooms:</strong> <?php echo htmlspecialchars($hostel['number_of_rooms']); ?><br>
                    <?php if ($hostel['hostel_image']): ?>
                        <strong>Hostel Image:</strong><br>
                        <img src="<?php echo htmlspecialchars($hostel['hostel_image']); ?>" alt="Hostel Image">
                    <?php endif; ?><br>
                    <button id="updateButton" onclick="openPopup('updatePopup<?php echo $hostel['owner_id']; ?>')">Update Details</button>
                </div>

                <!-- Popup for Updating Hostel Details -->
                <div id="updatePopup<?php echo $hostel['owner_id']; ?>" class="popup">
                    <div class="popup-content">
                        <span class="close" onclick="closePopup('updatePopup<?php echo $hostel['owner_id']; ?>')">&times;</span>
                        <h2>Update Hostel</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_hostel" value="1">
                            <label>Hostel Name:</label>
                            <input type="text" name="hostel_name" value="<?php echo htmlspecialchars($hostel['hostel_name']); ?>" required>
                            <label>Distance:</label>
                            <input type="number" name="distance" value="<?php echo htmlspecialchars($hostel['distance']); ?>" required>
                            <label>Contact:</label>
                            <input type="text" name="contact" value="<?php echo htmlspecialchars($hostel['contact']); ?>" required>
                            <label>Price:</label>
                            <input type="number" name="price" value="<?php echo htmlspecialchars($hostel['price']); ?>" required>
                            <label>Number of Rooms:</label>
                            <input type="number" name="number_of_rooms" value="<?php echo htmlspecialchars($hostel['number_of_rooms']); ?>" required>
                            <label>Upload New Image:</label>
                            <input type="file" name="hostel_image">
                            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($hostel['hostel_image']); ?>">
                            <input type="submit" value="Update">
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Popup for Adding a New Hostel -->
        <div id="addPopup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup('addPopup')">&times;</span>
                <h2>Add New Hostel</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="add_hostel" value="1">
                    <label>Hostel Name:</label>
                    <input type="text" name="hostel_name" required>
                    <label>Distance:</label>
                    <input type="number" name="distance" required>
                    <label>Contact:</label>
                    <input type="text" name="contact" required>
                    <label>Price:</label>
                    <input type="number" name="price" required>
                    <label>Number of Rooms:</label>
                    <input type="number" name="number_of_rooms" required>
                    <label>Upload Image:</label>
                    <input type="file" name="hostel_image">
                    <input type="submit" value="Add Hostel">
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <footer id="thefooter">
        <p>&copy; 2024 Find My Hostel. All rights reserved.</p>
        <p class="footer-right">FMH (By; Group 7) v1.0</p>
    </footer>

    <script>
        // Function to toggle the sidebar and main content width
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const topbar = document.getElementById('topbar');
            const footer = document.getElementById('thefooter');
    
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
            topbar.classList.toggle('collapsed');
            footer.classList.toggle('collapsed');
        }
    
        // Function to toggle the user dropdown visibility
        function toggleDropdown() {
            const userDropdown = document.querySelector('.user-dropdown');
            userDropdown.classList.toggle('active');
            const dropdownContent = userDropdown.querySelector('.user-dropdown-content');
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        }
    
        // Close dropdown if clicking outside of it
        window.onclick = function(event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const dropdownContent = userDropdown.querySelector('.user-dropdown-content');
    
            if (!userDropdown.contains(event.target)) {
                dropdownContent.style.display = "none";
                userDropdown.classList.remove('active'); // Ensure the active class is removed
            }
        }
    </script>    
</body>
</html>
