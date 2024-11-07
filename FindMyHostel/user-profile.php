<?php
    session_start();
    include 'config.php'; // Include your database configuration file

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php'); // Redirect to login if user is not logged in
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user details from the database
    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Handle form submission for updating user details
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        // Update user details in the database
        $updateQuery = "UPDATE users SET name = ?, email = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssi", $name, $email, $user_id);
        
        if ($updateStmt->execute()) {
            echo "Profile updated successfully.";
            // Refresh user details
            $user['name'] = $name;
            $user['email'] = $email;
        } else {
            echo "Error updating profile.";
        }
    }

    // Handle account deletion
    if (isset($_POST['delete'])) {
        $deleteQuery = "DELETE FROM users WHERE user_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $user_id);
        
        if ($deleteStmt->execute()) {
            session_destroy();
            header('Location: login.php'); // Redirect to login after deletion
            exit();
        } else {
            echo "Error deleting account.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic reset for body */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecfcff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container styling for the profile section */
        .profile-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Form styling */
        .profile-form,
        .delete-form {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #555;
            text-align: left;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Button styling */
        .update-button,
        .delete-button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .update-button {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .logout-button button {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }

        /* Hover effects */
        .update-button:hover {
            background-color: #45a049;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .logout-button button:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        
        <!-- Profile update form -->
        <form method="POST" class="profile-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <button type="submit" name="update" class="update-button">Update Profile</button>
        </form>

        <!-- Account deletion form -->
        <form method="POST" class="delete-form">
            <button type="submit" name="delete" class="delete-button" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                Delete Account
            </button>
        </form>
        
        <!-- Log out button -->
        <a href="logout.php" class="logout-button">
            <button type="button"><i class="fas fa-sign-out-alt"></i> Log Out</button>
        </a>
    </div>
</body>
</html>
