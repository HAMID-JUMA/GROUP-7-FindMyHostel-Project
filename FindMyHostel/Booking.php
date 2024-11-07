<?php
    session_start();

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_management_system";

    // Establish connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ensure user is logged in and retrieve user_id
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];
    $name = null;

    // Fetch user name based on user_id in session
    $stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = $user['name']; // Assign the user's name to $name
    }
    $stmt->close();

    // Check if there's already a booking for this user
    $existingBooking = null;
    $stmt = $conn->prepare("
        SELECT b.*, h.hostel_name, h.contact AS contact, h.price, u.name AS owner_name
        FROM bookings b
        JOIN hostels h ON b.hostel_id = h.owner_id
        JOIN users u ON h.owner_id = u.user_id
        WHERE b.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $existingBooking = $result->fetch_assoc();
    }
    $stmt->close();

    // Only retrieve hostel details if there's no existing booking
    $hostel = null;
    $hostel_id = $_GET['hostel_id'] ?? null;
    if (!$existingBooking && $hostel_id) {
        $stmt = $conn->prepare("SELECT hostel_name, distance, contact, price, hostel_image, number_of_rooms FROM hostels WHERE owner_id = ?");
        $stmt->bind_param("i", $hostel_id);
        $stmt->execute();
        $hostel = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    }

    // Handle booking form submission if no existing booking is found
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$existingBooking) {
        // Retrieve form data
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $booking_date = date('Y-m-d');

        // Check room availability
        $stmt = $conn->prepare("SELECT number_of_rooms FROM hostels WHERE owner_id = ?");
        $stmt->bind_param("i", $hostel_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $available_rooms = $result['number_of_rooms'] ?? 0;
        $stmt->close();

        // Count confirmed bookings
        $stmt = $conn->prepare("SELECT COUNT(*) as allocated_students FROM bookings WHERE hostel_id = ? AND status = 'confirmed'");
        $stmt->bind_param("i", $hostel_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $allocated_students = $result->fetch_assoc()['allocated_students'];
        $stmt->close();

        // Check if enough rooms are available
        if ($available_rooms > $allocated_students) {
            // Check if file was uploaded
            if (isset($_FILES['proof_of_payment']) && $_FILES['proof_of_payment']['error'] === UPLOAD_ERR_OK) {
                $proof_of_payment = 'hostel_owner/uploads/' . basename($_FILES['proof_of_payment']['name']);
                move_uploaded_file($_FILES['proof_of_payment']['tmp_name'], $proof_of_payment);

                // Insert booking into the database with status 'Pending'
                $stmt = $conn->prepare("INSERT INTO bookings (user_id, hostel_id, check_in, check_out, proof_of_payment, booking_date, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
                $stmt->bind_param("iissss", $user_id, $hostel_id, $check_in, $check_out, $proof_of_payment, $booking_date);
                if ($stmt->execute()) {
                    echo "<script>alert('Booking successful! Your booking request is pending approval.');</script>";
                } else {
                    echo "<script>alert('Booking failed: " . $stmt->error . "');</script>";
                }
                $stmt->close();
            } else {
                echo "<p>Please upload a valid proof of payment.</p>";
            }
        } else {
            echo "<p>Not enough rooms available for your request.</p>";
        }
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room Booking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/Style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ecfcff;
            margin: 0;
        }

        h1, h2 {
            color: #333;
        }

        /* Form styling */
        .hostel-info {
            background: #fff;
            border: 2px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .hostel-info img {
            max-width: 50%;
            height: auto;
            border-radius: 5px;
        }

        form {
            max-width: 35%;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="date"],
        form input[type="file"],
        form button {
            width: 70%;
            padding: 10px;
            margin-bottom: 15px;
        }

        form button {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }

        /* Receipt styling */
        .receipt {
            width: 30%;
            background-color: #fff; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            padding: 20px; 
            margin-top: 20px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); 
        }

        .receipt h2 {
            color: #333; 
            font-size: 24px; 
            margin-bottom: 15px; 
        }

        .receipt p {
            color: #555; 
            line-height: 1.6; 
        }

        .receipt .detail {
            display: flex; 
            justify-content: space-between; 
            padding: 8px 0; 
            border-bottom: 1px solid #218838; 
        }

        .receipt .detail:last-child {
            border-bottom: none; /* Remove border for the last detail */
        }
        .topbar {
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        height: 100px;        
        position: fixed;
        top: 0;
        z-index: 1000;
        }
    </style>
</head>
<body>
    <!-- Banner starts here -->
    <div class="banner topbar" >
            <div class="navbar">
                <img src="img/icons/logo.png" class="logo">  
                <ul>
                    <li><a href="student_home.php">Home</a></li>
                    <li><a href="Hostels.php">Hostels</a></li>
                    <li><a href="Booking.php">Booking</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
                <div class="book_dv" style="background-color: rgba(0, 0, 0, 0.5);">
                    <a href="Hostels.php" class="book_btn">Book Now</a>
                    <a href="user-profile.php" >
                        <img src="img/icons/user.png" class="profile"> <!--no link to the profile currently-->
                    </a> 
                </div>
            </div>
    </div>
    <!-- Banner ends here -->
    <!-- Main Content  -->
    <div style="    padding: 20px; padding-top:110px; ">
        <h1>Book a Room</h1>

        <?php if ($existingBooking): ?>
            <div class="receipt">
            <h2>Your Booking Receipt</h2>
            <div class="detail">
                <strong>Hostel Name:</strong>
                <p><?php echo htmlspecialchars($existingBooking['hostel_name']); ?></p>
            </div>
            <div class="detail">
                <strong>Owner Name:</strong>
                <p><?php echo htmlspecialchars($existingBooking['owner_name']); ?></p>
            </div>
            <div class="detail">
                <strong>Owner's Contact:</strong>
                <p><?php echo htmlspecialchars($existingBooking['contact']); ?></p>
            </div>
            <div class="detail">
                <strong>Price:</strong>
                <p>MK<?php echo htmlspecialchars($existingBooking['price']); ?></p>
            </div>
            <div class="detail">
                <strong>Student Name:</strong>
                <p><?php echo htmlspecialchars($user['name']); ?></p>
            </div>
            <div class="detail">
                <strong>Check-in Date:</strong>
                <p><?php echo htmlspecialchars($existingBooking['check_in']); ?></p>
            </div>
            <div class="detail">
                <strong>Check-out Date:</strong>
                <p><?php echo htmlspecialchars($existingBooking['check_out']); ?></p>
            </div>
            <div class="detail">
                <strong>Proof of Payment:</strong>
                <p><?php echo htmlspecialchars($existingBooking['proof_of_payment']); ?></p>
            </div>
            <div class="detail">
                <strong>Booking Date:</strong>
                <p><?php echo htmlspecialchars($existingBooking['booking_date']); ?></p>
            </div>
            <div class="detail">
                <strong>Status:</strong>
                <p><?php echo htmlspecialchars($existingBooking['status']); ?></p>
            </div>
            <div class="detail">
                <strong>Room Number:</strong>
                <p><?php echo htmlspecialchars($existingBooking['room_number']); ?></p>
            </div>
        </div>

        <?php elseif ($hostel): ?>
            <div class="hostel-info">
                <img src="hostel_owner/<?php echo htmlspecialchars($hostel['hostel_image']); ?>" alt="Hostel Image">
                <p><strong>Hostel Name:</strong> <?php echo htmlspecialchars($hostel['hostel_name']); ?></p>
                <p><strong>Distance:</strong> <?php echo htmlspecialchars($hostel['distance']); ?> km</p>
                <p><strong>Owner's Contact:</strong> <?php echo htmlspecialchars($hostel['contact']); ?></p>
                <p><strong>Price:</strong> MK<?php echo htmlspecialchars($hostel['price']); ?></p>
                <p><strong>Total Rooms:</strong> <?php echo htmlspecialchars($hostel['number_of_rooms']); ?></p>
            </div>
            <form method="POST" action="Booking.php?hostel_id=<?php echo htmlspecialchars($hostel_id); ?>" enctype="multipart/form-data">
                <label for="check_in">Check-in Date:</label>
                <input type="date" id="check_in" name="check_in" required>

                <label for="check_out">Check-out Date:</label>
                <input type="date" id="check_out" name="check_out" required>

                <label for="proof_of_payment">Proof of Payment:</label>
                <input type="file" id="proof_of_payment" name="proof_of_payment" accept="image/*" required>

                <button type="submit">Confirm Booking</button>
            </form>
        <?php else: ?>
            <p>Hostel not found. Please go to Hostels and select a valid hostel.</p>
        <?php endif; ?>
    </div>
    <!-- Main Content End -->
</body>
</html>
