<?php
    // Start the session
    session_start();

    // Connect to the database (update with your database credentials)
    $host = 'localhost';
    $dbname = 'hostel_management_system'; // Your DB name
    $username = 'root'; // Your DB username
    $password = ''; // Your DB password

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
        $password = $_POST['password']; // This is the plain-text password from the form

        // Query to check user by email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the plain-text password directly (NOT recommended for production)
        if ($user && $password === $user['password']) {
            // Login successful, store user data in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] == 'student') {
                header("Location: student_home.php");
            } elseif ($user['role'] == 'owner') {
                header("Location: hostel_owner/owner_dashboard.php");
            }
            elseif ($user['role'] == 'admin') {
                header("Location: admin/admin_dashboard.php");
            }
            
            exit;
        } else {
            // Invalid credentials, set error message
            $error_message = "Invalid email or password!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

     <!-- Google fonts "poppins" -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
     <!-- CSS for poppins font -->
     <style>
         *{
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
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 1px 0;
            position: absolute;
            top: 0;
            font-size: 50px
        }
        input{
            background-color: lightgrey;
        }
        
     </style>
    <link rel="stylesheet" href="style/Login.css">
</head>
<body >
    <h2 class="toph2">Find My Hostel</h2>
    

      <!-- right side with with background -->
      <div class="login-form">
        <h2> Log into your account</h2>

         

        <form action="login.php" method="POST">
        <label for="email">Email:</label>
          <input type="email" name="email" placeholder="Email">
          <label for="password">Password:</label>
          <input type="password" name="password" placeholder="Password">
          <p style="text-align: end;" >Forgot password?</p>
          <button type="submit" name="login">Login</button>
          
        </form>
        <!-- Display error message, if any -->
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <p style="transform: translateY(-35px);">Don't have an account? <a href="signup-process.php">Create one</a></p>
      </div>
        
    </div>
    
</body>
</html>