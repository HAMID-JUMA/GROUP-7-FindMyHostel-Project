<?php
    session_start();
    // Database connection
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

    // Query to fetch hostel details, including `id` and `owner_id` if they are necessary for booking and identification
    $sql = "SELECT owner_id, hostel_name, distance, contact, price, hostel_image, owner_id FROM hostels";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>FindMyHostel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts "Poppins" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="style/Style.css">
    <link rel="stylesheet" href="style/Hostel.css">

    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {   
            background: #ecfcff;
        }
    </style>
</head>
<body>
    <!-- Header Banner and Navigation -->
    <div class="banner">
        <div class="navbar">
            <img src="img/icons/logo.png" class="logo">
            <ul>
                <li><a href="student_home.php">Home</a></li>
                <li><a href="Hostels.php">Hostels</a></li>
                <li><a href="Booking.php">Booking</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
            <div class="book_dv">
            <a href="Hostels.php" class="book_btn">Book Now</a>
            <a href="user-profile.php" >
                <img src="img/icons/user.png" class="profile"> <!--no link to the profile currently-->
            </a> 
        </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container">
        <!-- Sidebar for Search and Filters -->
        <div class="side-nav">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search here..."><br><br><br>
            </div>
            <label for="price">Price Range</label>
            <input type="range" id="price" name="price" min="0" max="100" value="50"><br><br><br>
            <label for="location">Location</label><br>
            <select id="location" name="location">
                <option value="mmina">Mmina</option>
                <!-- Additional locations can be added here -->
            </select><br><br><br>
            <!-- Additional Filters -->
        </div>

        <!-- Hostel Listings Section -->
        <div class="main-cont">
            <?php if ($result->num_rows > 0): ?>
                <?php while($hostel = $result->fetch_assoc()): ?>
                    <div class="Hostel">
                        <!-- Display Hostel Image if available -->
                        <?php if (!empty($hostel['hostel_image'])): ?>
                            <img src="hostel_owner/<?php echo htmlspecialchars($hostel['hostel_image']); ?>" alt="Hostel Image">
                        <?php endif; ?>

                        <!-- Hostel Details -->
                        <div class="Hostel_content">
                            <strong>Hostel Name:</strong> <?php echo htmlspecialchars($hostel['hostel_name']); ?><br>
                            <strong>Distance:</strong> <?php echo htmlspecialchars($hostel['distance']); ?> km<br>
                            <strong>Contact:</strong> <?php echo htmlspecialchars($hostel['contact']); ?><br>
                            <strong>Price:</strong> MK<?php echo htmlspecialchars($hostel['price']); ?><br>
                            <!-- Booking link passing the unique hostel ID -->
                            <a href="Booking.php?hostel_id=<?php echo htmlspecialchars($hostel['owner_id']); ?>" class="btn">Book Now</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Display if no hostels are available -->
                <p>No hostels available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="Footer">
        <!-- Add your footer content here if needed -->
    </div>

    <!-- Copyright Section -->
    <div class="Copy_right">
        <p>&copy; 2024, System Design Aces. All Rights Reserved</p>
    </div>
</body>
</html>
<?php
    // Close database connection
    $conn->close();
?>
