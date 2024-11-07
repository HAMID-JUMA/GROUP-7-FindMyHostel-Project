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

    // Handle delete request
    if (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);
        $conn->query("DELETE FROM contact_messages WHERE id = $delete_id");
        header("Location: settings.php");
        exit;
    }

    // Fetch data from the contact_messages table
    $sql = "SELECT id, name, email, message, submitted_at FROM contact_messages";
    $result = $conn->query($sql);
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
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #163B65;
            color: #fff;
            font-weight: bold;
        }

        td {
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            text-align: left;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .modal-content p {
            color: #555;
            line-height: 1.5;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }
        /* Search and Filter section */
        .search-filter {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .search-filter input, .search-filter select {
                padding: 10px;
                font-size: 16px;
                margin-right: 10px;
                width: 100%;
                max-width: 300px;
            }

            .search-filter select {
                width: 200px;
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
    <div class="container">
            <h3>Message List</h3>
            <!-- Search and Filter Section -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search by name or email" onkeyup="searchStudent()">
                
            </div>
        <!-- Statistics Overview start -->
        <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0" id="messageTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars(substr($row['message'], 0, 30)); ?>...</td>
                        <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                        <td>
                            <!-- View More Button -->
                            <button onclick="viewMessage('<?php echo addslashes($row['message']); ?>')">View More</button>
                            
                            <!-- Delete Button -->
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>

        <!-- Modal for View More -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Message Details</h2>
                <p id="fullMessage"></p>
            </div>
        </div>

        <script>
            // Function to open modal and display full message
            function viewMessage(message) {
                document.getElementById("fullMessage").textContent = message;
                document.getElementById("myModal").style.display = "flex";
            }

            // Close the modal when the user clicks on <span> (x)
            document.querySelector(".close").onclick = function() {
                document.getElementById("myModal").style.display = "none";
            }

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function(event) {
                if (event.target == document.getElementById("myModal")) {
                    document.getElementById("myModal").style.display = "none";
                }
            }
        </script>
        <!-- Statistics Overview end -->
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
        // Search function for filtering students by name or email
        function searchStudent() {
                const searchInput = document.getElementById("searchInput").value.toLowerCase();
                const table = document.getElementById("messageTable");
                const rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByTagName("td")[1];
                    const emailCell = rows[i].getElementsByTagName("td")[2];

                    if (nameCell || emailCell) {
                        const name = nameCell.textContent || nameCell.innerText;
                        const email = emailCell.textContent || emailCell.innerText;

                        if (name.toLowerCase().includes(searchInput) || email.toLowerCase().includes(searchInput)) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            }

    </script>    
</body>
</html>