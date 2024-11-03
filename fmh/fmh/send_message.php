<?php
    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_management_system";

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize form data
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Response</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; text-align: center; margin: 50px; }
        .message { padding: 20px; border-radius: 5px; max-width: 500px; margin: auto; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="message <?php echo !empty($errors) ? 'error' : 'success'; ?>">
        <?php if (!empty($successMessage)): ?>
            <p><?php echo $successMessage; ?></p>
        <?php else: ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <p><a href="contact_us.php">Go back to Contact Us page</a></p>
</body>
</html>
