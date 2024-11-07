<?php
    session_start(); // Start the session

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_management_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define queries for each statistic
    $queries = [
        "hostels" => "SELECT COUNT(*) AS count FROM hostels",
        "students" => "SELECT COUNT(*) AS count FROM users WHERE role = 'student'",
        "hostel_owners" => "SELECT COUNT(*) AS count FROM users WHERE role = 'owner'",
        "total_rooms" => "SELECT SUM(number_of_rooms) AS count FROM hostels", 
        "confirmed_applications" => "SELECT COUNT(*) AS count FROM bookings WHERE status = 'confirmed'",
        "pending_applications" => "SELECT COUNT(*) AS count FROM bookings WHERE status = 'pending'",
        "denied_applications" => "SELECT COUNT(*) AS count FROM bookings WHERE status = 'denied'",
        "new_users" => "SELECT COUNT(*) AS count FROM users WHERE created_at >= NOW() - INTERVAL 30 DAY",
        "received_messages" => "SELECT COUNT(*) AS count FROM contact_messages" 
    ];

    // Array to store the results
    $stats = [];

    // Execute each query and store the result
    foreach ($queries as $key => $sql) {
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $stats[$key] = $row['count'];
    }

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

        /* Statistics Container */
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        /* Stat Card Styles */
        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 13px rgba(0, 0, 0, 0.4);
            flex: 1;
            min-width: 200px;
            max-width: 220px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-card i {
            font-size: 40px;
            color: #163B65;
        }

        .stat-info {
            text-align: right;
        }

        .stat-info h4 {
            margin: 0;
            font-size: 18px;
            color: #163B65;
        }

        .stat-info p {
            margin: 5px 0 0;
            font-size: 24px;
            color: #333;
        }
    
    </style>


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
                <li><a href="admin_dashboard.php" active><i class="fas fa-tachometer-alt"></i><span class="link-text">Dashboard</span></a></li>
                <li><a href="hostels-owners-management.php"><i class="fas fa-building"></i><span class="link-text">Manage Hostels owners</span></a></li>
                <li><a href="students-management.php"><i class="fas fa-user-graduate"></i><span class="link-text">Manage Students</span></a></li>
                <li><a href="Settings.php"><i class="fas fa-envelope"></i><span class="link-text">Settings</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Top bar -->
    <div class="topbar" id="topbar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Find My Hostel - Admin Panel</h2>

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
        <!-- Statistics Overview start -->
        <div class="container">
    <h3>System Overview</h3>
    

    <!-- Statistics Section -->
    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-building"></i>
            <div class="stat-info">
                <h4>Hostels</h4>
                <p><?php echo $stats['hostels']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <div class="stat-info">
                <h4>Students</h4>
                <p><?php echo $stats['students']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-user"></i>
            <div class="stat-info">
                <h4>Hostel Owners</h4>
                <p><?php echo $stats['hostel_owners']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-building"></i>
            <div class="stat-info">
                <h4>Total Rooms</h4>
                <p><?php echo $stats['total_rooms']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-check-circle"></i>
            <div class="stat-info">
                <h4>Confirmed Applications</h4>
                <p><?php echo $stats['confirmed_applications']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <div class="stat-info">
                <h4>Pending Applications</h4>
                <p><?php echo $stats['pending_applications']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-times-circle"></i>
            <div class="stat-info">
                <h4>Denied Applications</h4>
                <p><?php echo $stats['denied_applications']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-plus"></i>
            <div class="stat-info">
                <h4>New Users (Last 30 Days)</h4>
                <p><?php echo $stats['new_users']; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="stat-info">
                <h4>Received Messages</h4>
                <p><?php echo $stats['received_messages']; ?></p>
            </div>
        </div>
    </div>
</div>

        <!-- Statistics Overview end -->
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
