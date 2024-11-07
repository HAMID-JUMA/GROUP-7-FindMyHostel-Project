<?php
    // Start the session
    session_start();

    // Database connection (update with your database credentials)
    $host = 'localhost';
    $dbname = 'hostel_management_system';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    // Initialize error message
    $error_message = '';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check user by email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the hashed password
        if ($user && $password === $user['password']) {
            // Login successful, store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] == 'student') {
                header("Location: student_home.php");
            } elseif ($user['role'] == 'owner') {
                header("Location: hostel_owner/owner_dashboard.php");
            } elseif ($user['role'] == 'admin') {
                header("Location: admin/admin_dashboard.php");
            }
            exit;
        } else {
            // Invalid credentials
            $error_message = "Invalid email or password!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google fonts "Poppins" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- CSS for poppins font and styling -->
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
        .toph2 {
            color: #163B65;
            font-size: 50px;
            position: absolute;
            top: 0;
            width: 100%;
            text-align: center;
            padding-top: 10px;
        }
        .login-form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: lightgrey;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #65B579;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #14548e;
        }
        .alert-danger {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2 class="toph2">Find My Hostel</h2>

    <div class="login-form">
        <h2>Log into your account</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required>
            <p style="text-align: end;"><a href="#">Forgot password?</a></p>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if (!empty($error_message)) : ?>
            <div class="alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <p>Don't have an account? <a href="signup-process.php">Create one</a></p>
    </div>
</body>
</html>
