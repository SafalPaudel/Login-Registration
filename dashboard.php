<?php
// Include the database connection file to connect with the database
include 'db.php';

// Start a PHP session to store and manage the login state
session_start();  

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username and password entered in the form
    $username = $_POST['username']; // The username from the login form
    $password = $_POST['password']; // The password from the login form

    // Prepare a SQL statement to fetch user details from the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind the username parameter to the SQL query
    $stmt->execute(); // Execute the query
    $stmt->bind_result($id, $hashed_password); // Bind the result variables
    $stmt->fetch(); // Fetch the result from the executed query

    // Check if the entered password matches the hashed password stored in the database
    if (password_verify($password, $hashed_password)) {
        // If password is correct, set the session user_id to the fetched user ID
        $_SESSION['user_id'] = $id; 
        header("Location: dashboard.php"); // Redirect to the dashboard page
        exit; // Exit the script to prevent further execution
    } else {
        // If the username or password is incorrect, set an error message
        $error_message = "Invalid username or password."; 
    }

    // Close the prepared statement to free up resources
    $stmt->close(); 
    // Close the database connection
    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset all margins and padding to ensure consistent styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling: Set a gradient background and center content */
        body {
            font-family: Arial, sans-serif; /* Use a clean font */
            background: linear-gradient(135deg, #4facfe, #00f2fe); /* Gradient color */
            display: flex; /* Flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Full viewport height */
        }

        /* Styling for the login form container */
        .container {
            background: #ffffff; /* White background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            width: 350px; /* Fixed width */
            padding: 20px; /* Inner padding */
            text-align: center; /* Center-align text */
        }

        /* Title styling */
        .container h2 {
            margin-bottom: 20px;
            color: #333; /* Dark text color */
        }

        /* Form group for input fields */
        .form-group {
            margin-bottom: 15px; /* Spacing between fields */
            text-align: left; /* Align labels to the left */
        }

        /* Label styling for input fields */
        .form-group label {
            display: block; /* Block display for proper spacing */
            font-size: 14px;
            color: #555; /* Slightly darker text color */
        }

        /* Input field styling */
        .form-group input {
            width: 100%; /* Full width */
            padding: 10px; /* Inner padding for better click area */
            margin-top: 5px;
            border: 1px solid #ddd; /* Light border */
            border-radius: 4px; /* Rounded corners */
            font-size: 14px;
        }

        /* Highlight input field on focus */
        .form-group input:focus {
            outline: none; /* Remove default outline */
            border-color: #4facfe; /* Highlight border */
            box-shadow: 0 0 5px rgba(79, 172, 254, 0.5); /* Glow effect */
        }

        /* Button styling */
        .btn {
            width: 100%; /* Full width */
            padding: 10px;
            background: #4facfe; /* Button color */
            border: none; /* Remove default border */
            border-radius: 4px; /* Rounded corners */
            color: white; /* White text */
            font-size: 16px;
            cursor: pointer; /* Pointer cursor on hover */
            transition: background 0.3s; /* Smooth hover transition */
        }

        /* Hover effect for button */
        .btn:hover {
            background: #00a4fe; /* Darker blue on hover */
        }

        /* Error message styling */
        .error {
            color: red; /* Highlight errors in red */
            margin-bottom: 10px;
        }

        /* Register link styling */
        .register-link {
            margin-top: 15px;
            display: block; /* Separate block for spacing */
            font-size: 14px;
            color: #4facfe; /* Link color */
            text-decoration: none; /* Remove underline */
            transition: color 0.3s; /* Smooth color transition */
        }

        /* Hover effect for register link */
        .register-link:hover {
            color: #00a4fe; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <!-- Display error message if the login fails -->
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="post">
            <!-- Username input field -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <!-- Password input field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn">Login</button>
        </form>
        <!-- Link to registration page -->
        <a href="register.php" class="register-link">Don’t have an account? Register here</a>
    </div>
</body>
</html>
