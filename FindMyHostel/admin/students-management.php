<?php
    session_start(); // Start the session to manage user login

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_management_system";

    // Establish a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle booking status update if the form is submitted in the view modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'], $_POST['status'])) {
        $booking_id = $_POST['booking_id'];
        $new_status = $_POST['status'];
        $room_number = isset($_POST['room_number']) ? $_POST['room_number'] : null;

        // Prepare the update query
        $sql = "UPDATE bookings SET status = ? " . ($new_status === 'confirmed' ? ", room_number = ?" : "") . " WHERE booking_id = ?";
        
        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            if ($new_status === 'confirmed') {
                $stmt->bind_param("ssi", $new_status, $room_number, $booking_id);
            } else {
                $stmt->bind_param("si", $new_status, $booking_id);
            }

            // Execute the statement and check for success
            if ($stmt->execute()) {
                echo "<script>alert('Booking status updated successfully!');</script>";
            } else {
                echo "Error updating booking status: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    // Query to fetch bookings for the specific hostel owned by the logged-in user
    $bookings_sql = "SELECT b.*, u.name AS user_name, u.email AS user_email, b.proof_of_payment
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id";

// Prepare and execute the bookings query
if ($bookings_stmt = $conn->prepare($bookings_sql)) {
$bookings_stmt->execute();
$bookings_result = $bookings_stmt->get_result();
} else {
echo "Error preparing bookings statement: " . $conn->error;
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
        /* Basic page styling */

        .container {
            width: 95%;
            margin-top: 20px;
        }
        h3 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
                background-color: #163B65;
                color: white;
            }
        select {
            padding: 5px;
        }
        .modal {
            display: none; /* Hide modal by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure modal is above other content */
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            width: 300px;
            text-align: center;
            border-radius: 8px;
        }
        .modal-content h3 {
            margin-top: 0;
            color: #333;
        }
        .modal-content select, .modal-content button, .modal-content input {
            margin-top: 10px;
            padding: 5px;
        }
        .proof_of_payment {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            margin-top: 10px;
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
        <h3>Bookings List</h3>
                    <!-- Search and Filter Section -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search by name or email" onkeyup="searchStudent()">
                <select id="filterStatus" onchange="filterByStatus()">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Denied">Denied</option>
                </select>
            </div>
        <!-- Bookings Table -->
        <table id="studentTable">
            <thead>
                <tr>
                    <th>Srudent name</th>
                    <th>Email</th>
                    <th>Booking Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($booking['user_email']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($booking['status'])); ?></td>
                    <td>
                        <select onchange="handleAction(this, <?php echo htmlspecialchars($booking['booking_id']); ?>, '<?php echo htmlspecialchars($booking['proof_of_payment']); ?>')">
                            <option value="" disabled selected>Choose Action</option>
                            <option value="view">View</option>
                            <option value="delete">Delete</option>
                        </select>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <h3>Booking Details</h3>
            <form action="" method="POST">
                <input type="hidden" id="modalBookingId" name="booking_id" value="">
                <label>Status:</label>
                <select name="status" id="modalStatus" onchange="toggleRoomNumberInput(this)">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="denied">Denied</option>
                </select>
                <div id="roomNumberInputContainer" style="display:none;">
                    <label>Room Number:</label>
                    <input type="text" name="room_number" id="roomNumberInput" placeholder="Enter Room Number">
                </div>
                <button type="submit">Update Status</button>
            </form>
            <img id="proof_of_payment" class="proof_of_payment" src="" alt="Proof of Payment">
            <button onclick="closeModal()">Close</button>
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
                // Handle the action selection (view/delete) in the bookings table
                function handleAction(selectElement, bookingId, proof_of_payment) {
            const action = selectElement.value;

            if (action === 'view') {
                // Display the modal and populate the fields
                document.getElementById('viewModal').style.display = 'flex';
                document.getElementById('modalBookingId').value = bookingId;
                const statusText = selectElement.closest('tr').querySelector('td:nth-child(3)').textContent.toLowerCase();
                document.getElementById('modalStatus').value = statusText;
                document.getElementById('proof_of_payment').src = proof_of_payment ? 'uploads/' + proof_of_payment : '';
                document.getElementById('proof_of_payment').style.display = proof_of_payment ? 'block' : 'none';
                toggleRoomNumberInput(document.getElementById('modalStatus')); // Check if room number input should be displayed
            } else if (action === 'delete') {
                // Confirm deletion
                if (confirm("Are you sure you want to delete this booking?")) {
                    window.location.href = `delete_booking.php?booking_id=${bookingId}`;
                }
            }
            selectElement.selectedIndex = 0; // Reset select dropdown
        }

        // Show or hide the room number input based on selected status
        function toggleRoomNumberInput(statusSelect) {
            const roomNumberInputContainer = document.getElementById('roomNumberInputContainer');
            roomNumberInputContainer.style.display = statusSelect.value === 'confirmed' ? 'block' : 'none';
        }

        // Close the modal
        function closeModal() {
            document.getElementById('viewModal').style.display = 'none';
        }
                 // Search function for filtering students by name or email
                 function searchStudent() {
                const searchInput = document.getElementById("searchInput").value.toLowerCase();
                const table = document.getElementById("studentTable");
                const rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByTagName("td")[0];
                    const emailCell = rows[i].getElementsByTagName("td")[1];

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

            // Filter students by application status
            function filterByStatus() {
                const filter = document.getElementById("filterStatus").value;
                const table = document.getElementById("studentTable");
                const rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    const statusCell = rows[i].getElementsByTagName("td")[2];

                    if (statusCell) {
                        const status = statusCell.textContent || statusCell.innerText;

                        if (filter === "" || status === filter) {
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
<?php
    $conn->close(); // Close the database connection
?>