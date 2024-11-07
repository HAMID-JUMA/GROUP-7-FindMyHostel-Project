<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Find My Hostel</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your stylesheet if needed -->
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        header h1 {
            margin-bottom: 0.5em;
        }

        header nav a {
            color: #fff;
            margin: 0 1em;
            text-decoration: none;
            font-weight: bold;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        /* Main Section */
        main {
            padding: 2em;
            max-width: 800px;
            margin: auto;
        }

        .contact {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .contact h2 {
            color: #4CAF50;
            margin-bottom: 0.5em;
        }

        .contact p {
            margin-bottom: 1em;
        }

        .contact-info h3 {
            color: #333;
            margin-top: 1em;
        }

        .contact-info p {
            margin-bottom: 1em;
        }

        /* Contact Form */
        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            margin-bottom: 0.3em;
            color: #4CAF50;
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 0.7em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
        }

        .contact-form button {
            background-color: #4CAF50;
            color: #fff;
            padding: 0.7em;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #45a049;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1em;
            background-color: #4CAF50;
            color: #fff;
            margin-top: 2em;
        }

        footer p {
            margin: 0;
        }

    </style>
</head>
<body>
    <header>
        <h1>Find My Hostel</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact Us</a>
        </nav>
    </header>
    
    
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
 * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f4f4f9;
        padding: 20px;
    }

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
        background-color: #4CAF50;
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

    button {
        padding: 8px 12px;
        margin: 0 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
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
                <img src="gare1.jpeg" alt="User Profile Picture">Gareth Chimimba
            </button>
            <div class="user-dropdown-content">
                <a href="account-management.html"><i class="fas fa-user"></i>My Account</a>
                <a href="login.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
       </div>
    </div>

    <!-- Main content area -->
    <div class="main-content" id="main-content">
        <!-- Statistics Overview start -->
        <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
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

    <?php $conn->close(); ?>

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

    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Find My Hostel. All rights reserved.</p>
    </footer>
</body>
</html>
