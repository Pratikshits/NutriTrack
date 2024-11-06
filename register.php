<?php
include 'db.php';

// Initialize error messages
$name_error = $username_error = $password_error = $mobile_error = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $is_valid = true; // Flag to track overall validity

    // Validate Full Name
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $name_error = "Full Name must contain only letters and spaces.";
        $is_valid = false;
    }

    // Validate Username
    if (!preg_match("/^[a-zA-Z0-9]{5,}$/", $username)) {
        $username_error = "Username must be at least 5 characters long and contain only letters and numbers.";
        $is_valid = false;
    }

    // Validate Password
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        $password_error = "Password must be at least 8 characters long and contain at least one letter and one number.";
        $is_valid = false;
    }

    // Validate Mobile Number
    if (!preg_match("/^\d{10}$/", $mobile)) {
        $mobile_error = "Mobile Number must be exactly 10 digits.";
        $is_valid = false;
    }

    // If all validations pass, insert into database
    if ($is_valid) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO users (name, username, password, mobile) VALUES ('$name', '$username', '$hashed_password', '$mobile')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        form {
            width: 400px; /* Increased width for better layout */
            margin: auto;
            padding: 30px; /* Increased padding */
            background-color: white;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); /* Softer shadow */
            margin-top: 100px; /* Space from the top */
        }
        input[type=text], input[type=password], input[type=number] {
            width: 100%;
            padding: 12px; /* Increased padding */
            margin-bottom: 15px; /* Increased margin */
            border: 1px solid #ccc; /* Border styling */
            border-radius: 5px; /* Rounded borders */
            font-size: 14px; /* Font size for inputs */
        }
        button {
            width: 100%;
            padding: 12px; /* Increased padding */
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
            font-size: 16px; /* Increased button font size */
        }
        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .error {
            color: red; /* Red color for error messages */
            font-size: 12px; /* Smaller font size for errors */
            margin-top: -10px; /* Slightly lift the error message */
            margin-bottom: 10px; /* Space below error message */
        }
        a {
            display: block; /* Block display for links */
            text-align: center; /* Center the link */
            margin-top: 20px; /* Space above the link */
            color: #2196F3; /* Blue color for links */
            text-decoration: none; /* Remove underline */
        }
        a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>

<form method="post" action="">
    <h2>Register</h2>
    
    <input type="text" name="name" required placeholder="Full Name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
    <div class="error"><?php echo $name_error; ?></div>

    <input type="text" name="username" required placeholder="Username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
    <div class="error"><?php echo $username_error; ?></div>

    <input type="password" name="password" required placeholder="Password">
    <div class="error"><?php echo $password_error; ?></div>

    <input type="number" name="mobile" required placeholder="Mobile Number" value="<?php echo isset($mobile) ? htmlspecialchars($mobile) : ''; ?>">
    <div class="error"><?php echo $mobile_error; ?></div>

    <button type="submit">Register</button>
</form>

<a href="login.php">Already have an account? Login here.</a>

</body>
</html>
