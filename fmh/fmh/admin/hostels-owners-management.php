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

    // Fetch data from the hostels table
    $sql = "SELECT owner_id, hostel_name, owner_name, distance, contact, price FROM hostels";
    $result = $conn->query($sql);
    $hostels = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hostels[] = $row;
        }
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FMH(Hostels owners) - Admin Panel</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            /* Student Management start */
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

            /* Table styles */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table, th, td {
                border: 1px solid #ddd;
            }

            th, td {
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #163B65;
                color: white;
            }

            /* Button styles */
            .action-btn {
                padding: 8px 12px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
            }

            .action-btn:hover {
                background-color: #45a049;
            }

        
            /* Modal styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 600px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            /* Responsive design */
            @media (max-width: 768px) {
                .search-filter {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .search-filter input, .search-filter select {
                    margin-bottom: 10px;
                    width: 100%;
                }
            }
            /* Student Management end */
    
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
                <a href="account-management.html"><i class="fas fa-user"></i>My Account</a>
                <a href="logout.html"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
       </div>
    </div>

    <!-- Main content area -->
    <div class="main-content" id="main-content">
        <!-- Student Management start-->
        <div class="container">
            <h3>Hostel Owners List</h3>
            <!-- Search and Filter Section -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search by name" onkeyup="searchHostel()">

            </div>

            <!-- Student Table -->
            <table id="hostelTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll()"></th>
                        <th>Owner ID</th>
                        <th>Owner Name</th>
                        <th>Contact</th>
                        <th>Hostel Name</th>
                        <th>Distance</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hostels as $hostel): ?>
                    <tr>
                        <td><input type="checkbox" class="selectHostel"></td>
                        <td><?php echo $hostel['owner_id']; ?></td>
                        <td><?php echo $hostel['owner_name']; ?></td>
                        <td><?php echo $hostel['contact']; ?></td>
                        <td><?php echo $hostel['hostel_name']; ?></td>
                        <td><?php echo $hostel['distance']; ?></td>
                        <td><?php echo $hostel['price']; ?></td>
                        <td><button class="action-btn" onclick="editHostel(<?php echo $hostel['owner_id']; ?>, '<?php echo $hostel['owner_name']; ?>', '<?php echo $hostel['contact']; ?>', '<?php echo $hostel['hostel_name']; ?>', '<?php echo $hostel['distance']; ?>')">Edit</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Edit Student Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Edit Owner</h2>
                <form id="editForm">
                    <label for="ownerId">Owner ID:</label>
                    <input type="text" id="ownerId" disabled>
                    <label for="ownerName">Owner Name:</label>
                    <input type="text" id="ownerName" required>
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" required>
                    <label for="hostelName">Hostel Name:</label>
                    <input type="text" id="hostelName" required>
                    <label for="distance">Distance:</label>
                    <input type="text" id="distance" required>
                    <button type="button" class="action-btn" onclick="updateHostel()">Update</button>
                </form>
            </div>
        </div>

        <script>
            function searchHostel() {
                const searchInput = document.getElementById("searchInput").value.toLowerCase();
                const rows = document.getElementById("hostelTable").getElementsByTagName("tr");
    
                for (let i = 1; i < rows.length; i++) {
                    const name = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                    rows[i].style.display = name.includes(searchInput) ? "" : "none";
                }
            }
    
            function toggleSelectAll() {
                const selectAllCheckbox = document.getElementById("selectAll");
                document.querySelectorAll(".selectHostel").forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            }
    
            function editHostel(id, ownerName, contact, hostelName, distance) {
                document.getElementById("ownerId").value = owner_id;
                document.getElementById("ownerName").value = ownerName;
                document.getElementById("contact").value = contact;
                document.getElementById("hostelName").value = hostelName;
                document.getElementById("distance").value = distance;
    
                document.getElementById("editModal").style.display = "block";
            }
    
            function closeModal() {
                document.getElementById("editModal").style.display = "none";
            }
    
            function updateHostel() {
                const owner_id = document.getElementById("ownerId").value;
                const ownerName = document.getElementById("ownerName").value;
                const contact = document.getElementById("contact").value;
                const hostelName = document.getElementById("hostelName").value;
                const distance = document.getElementById("distance").value;
    
                fetch('update_owner.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ owner_id, ownerName, contact, hostelName, distance })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Hostel owner updated successfully!");
                        closeModal();
                        location.reload();
                    } else {
                        alert("Failed to update hostel owner.");
                    }
                });
            }
        </script>
        <!-- Student Management end-->
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
                const table = document.getElementById("studentTable");
                const rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByTagName("td")[2];
                    const emailCell = rows[i].getElementsByTagName("td")[3];

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
                    const statusCell = rows[i].getElementsByTagName("td")[6];

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

            // Select/Deselect all students
            function toggleSelectAll() {
                const selectAllCheckbox = document.getElementById("selectAll");
                const studentCheckboxes = document.querySelectorAll(".selectStudent");

                studentCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            }

            // Edit student action
            function editStudent(id, name, email, course, hostelStatus, applicationStatus) {
                document.getElementById("studentId").value = id;
                document.getElementById("studentName").value = name;
                document.getElementById("studentEmail").value = email;
                document.getElementById("studentCourse").value = course;
                document.getElementById("hostelStatus").value = hostelStatus;
                document.getElementById("applicationStatus").value = applicationStatus;

                const modal = document.getElementById("editModal");
                modal.style.display = "block";
            }

            // Close the modal
            function closeModal() {
                const modal = document.getElementById("editModal");
                modal.style.display = "none";
            }

            // Update student details
            function updateStudent(event) {
                event.preventDefault(); // Prevent the form from submitting
                alert("Student details updated successfully!"); // Here you can handle the update logic
                closeModal(); // Close the modal after update
            }

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                const modal = document.getElementById("editModal");
                if (event.target === modal) {
                    closeModal();
                }
            };
    </script>    
</body>
</html>
