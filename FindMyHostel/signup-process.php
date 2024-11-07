<?php
    // Database configuration
    $dsn = "mysql:host=localhost;dbname=hostel_management_system;charset=utf8";
    $db_user = "root"; 
    $db_pass = ""; 

    try {
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Capture form data with validation
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
            $role = isset($_POST['role']) ? $_POST['role'] : null;

            // Check if all required fields are filled out
            if (!$name || !$email || !$password || !$confirm_password || !$role) {
                echo "All fields are required. Please go back and complete the form.";
                exit();
            }

            // Check if passwords match
            if ($password !== $confirm_password) {
                echo "Passwords do not match. Please go back and try again.";
                exit();
            }

            // Create a PDO instance
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL to insert data into users table
            $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            // Store the plain text password without hashing
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);

            // Execute and check if successful
            if ($stmt->execute()) {
                echo "<p style='color: lightgreen;'>Sign-up successful! You can now <a href='login.php'>login here</a>.</p>";
            } else {
                echo "<p style='color: yellow;'>Sign-up failed. Please try again.</p>";
            }
        } else {
            echo "<p style='color: white;'>fill the form</p>";
        }

    } catch (PDOException $e) {
        // Catch any errors
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Find My Hostel</title>
    <link rel="stylesheet" href="style/Login.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            background-image: url('img/login.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        label, input, select, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input, select {
            padding: 8px;
            background-color: #c0c0c0;
            border: none;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
        }
        p a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <form action="signup-process.php" method="POST">
            <h3>Sign Up</h3>

            <!-- User role selection -->
            <label for="role">I am a:</label>
            <select name="role" id="role" required>
                <option value="">Select</option>
                <option value="student">Student</option>
                <option value="owner">Hostel Owner</option>
            </select>

            <!-- Name input -->
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <!-- Email input -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <!-- Password input -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <!-- Confirm password input -->
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br>
            <!-- Sign up button -->
            <button type="submit">Sign Up</button>

            <!-- Redirect to login -->
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>

