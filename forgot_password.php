<?php
session_start();

// Initialize failed attempts counter
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

// If attempts exceed 3
if ($_SESSION['attempts'] >= 3) {
    die("You have exceeded the maximum number of attempts. Please try again later.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $errors = [];

    // Email validation
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Password validation
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If validation passed
    if (empty($errors)) {
        // Example: Save to database (not implemented here)
        echo "User registered successfully!";
        $_SESSION['attempts'] = 0; // reset attempts on success
    } else {
        $_SESSION['attempts']++;
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
<h2>Register</h2>
<form method="POST" action="">
    <label>Email:</label><br>
    <input type="text" name="email" value=""><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" value=""><br><br>

    <input type="submit" value="Register">
</form>
</body>
</html>
