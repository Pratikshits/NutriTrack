<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username
    if (!preg_match("/^[a-zA-Z0-9]{5,}$/", $username)) {
        echo "Username must be at least 5 characters long and contain only letters and numbers.";
        exit();
    }

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: bmi_input.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #4caf50, #81c784); /* Gradient background */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form {
            width: 500px; /* Increased width */
            padding: 40px; /* Increased padding */
            background-color: white;
            border-radius: 15px; /* More rounded corners */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Softer shadow */
            text-align: center;
        }
        h2 {
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem; /* Larger font size */
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px; /* Increased padding for inputs */
            margin-bottom: 15px; /* Increased spacing between inputs */
            border: 1px solid #ddd;
            border-radius: 8px; /* More rounded edges */
            transition: border-color 0.3s;
            font-size: 1rem; /* Larger font size */
        }
        input[type=text]:focus, input[type=password]:focus {
            border-color: #66bb6a; /* Lighter green on focus */
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px; /* Increased padding for button */
            background-color: #388e3c; /* Darker green */
            color: white;
            border: none;
            border-radius: 8px; /* More rounded edges */
            cursor: pointer;
            font-size: 1rem; /* Larger font size */
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #2e7d32; /* Darker green on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }
        a {
            display: block;
            margin-top: 15px;
            color: #388e3c; /* Matching link color */
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        a:hover {
            color: #2e7d32; /* Darker green on hover */
            text-decoration: underline;
        }
    </style>
</head> 
<body> 
<form method="post" action=""> 
   <h2>Login</h2> 
   <input type="text" name="username" required placeholder="Username"> 
   <input type="password" name="password" required placeholder="Password"> 
   <button type="submit">Login</button> 
</form> 
<a href="register.php">Don't have an account? Register here.</a> 
</body> 
</html>