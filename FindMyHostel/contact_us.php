<?php
    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_management_system";

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Initialize an array to store error messages
        $errors = [];

        // Validate form fields
        if (empty($name)) {
            $errors[] = "Name is required.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }
        if (empty($message)) {
            $errors[] = "Message is required.";
        }

        // If no errors, save the data in the database
        if (empty($errors)) {
            // Create database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            // Execute the statement and check if it was successful
            if ($stmt->execute()) {
                $successMessage = "Thank you for contacting us, $name. We will get back to you soon!";
            } else {
                $errors[] = "Failed to save your message. Please try again later.";
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>FindMyHostel</title>
        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">
        
        <!-- Google fonts "poppins" -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- main stylesheets -->
        <link rel="stylesheet" href="style/Style.css">
        <link rel="stylesheet" href="style/Contact_Us.css">

        <!-- CSS starts here-->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            body {
                background-color: #ecfcff;
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
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.4);
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
        <!-- Banner starts here -->
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
    <!-- Banner ends here -->

    <main>
        <section class="contact">
            <h2>Contact Us</h2>
            <p>Need help or have questions? Get in touch with us!</p>

            <div class="contact-info">
                <h3>Email</h3>
                <p>garethchimimba@must.ac.mw</p>

                <h3>Phone</h3>
                <p>0998276461</p>

                <h3>Office Address</h3>
                <p>Blantyre, Limbe, P.O.Box 5169</p>
            </div>

            <h3>Send Us a Message</h3>
            <form action="send_message.php" method="post" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

<!-- Footer Starts here-->
    <div class="Footer">
        <!-- Quick links -->
        <div class="Ft Pages">
            <ul>
                <h3>PAGES</h3>
                <li><a href="Home.html">Home</a></li>
                <li><a href="Hostels.html">Hostels</a></li>
                <li><a href="Booking.html">Booking</a></li>
                <li><a href="Contac Us.html">Contact Us</a></li>
            </ul>

        </div>

        <!-- Quick Links -->
        <div class="Ft Quick_links">
            <ul>
                <h3>QUICK LINKS</h3>
                <li><a href="#About_us">About Us</a></li>
                <li><a href="#Trust">Why Trusting Us</a></li>
                <li><a href="#FHostels">Featured Hostels</a></li>
                <li><a href="#Gallery">Gallery</a></li>
                <li><a href="#Testimonials">Testimonials</a></li>
            </ul>
        </div>


        <!-- help -->
        <div class="Ft Help">
            <ul>
                <h3>HELP</h3>
                <li><a href="#FAQ">FAQ</a></li>
                <li><a href="Contac Us.html">Contact Us</a></li>
            </ul>

        </div>


        <!-- Sign Up -->
        <div class="Ft Register">
            <p>Signup to get 100% off your first booking</p> <br>

            <form> 
                <input type="email" id="Signup_email" placeholder=" Enter Your Email Address Here"> 

            </form>

            <button id="Signup">Sign up</button>

            <a href="Home.html">
                <img src="img/icons/logo.png" style="transform: translateY(-20px); width:58px; height: 58px;">
            </a>
            <img src="img/icons/ig.png">
            <img src="img/icons/x.png">
            <img src="img/icons/fb.png">

        </div>
    </div>

    <!-- Copyright info -->
    <div class="Copy_right">
        <p>&copy; 2024, System Design Aces. All Rights Reserved</p>
    </div>
<!-- Footer Ends here-->
    </body>
</html>