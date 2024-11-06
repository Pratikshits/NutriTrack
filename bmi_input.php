<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMI Input</title>
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
        input[type=number], select {
            width: 100%;
            padding: 15px; /* Increased padding for inputs */
            margin-bottom: 15px; /* Increased spacing between inputs */
            border: 1px solid #ddd;
            border-radius: 8px; /* More rounded edges */
            font-size: 1rem; /* Larger font size */
            transition: border-color 0.3s;
        }
        input[type=number]:focus, select:focus {
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
        label {
            margin-top: 10px;
            display: block;
            color: #333;
            font-weight: bold; /* Bold labels for better visibility */
        }
    </style>
</head>
<body>

<form method="post" action="bmi_result.php">
    <h2>Enter Your Details</h2>
    <input type="number" name="height" required placeholder="Height (cm)">
    <input type="number" name="weight" required placeholder="Weight (kg)">
    
    <label for="disease">Select Your Lifetime Disease:</label>
    <select name="disease[]" id="disease" multiple required>
        <option value="None">None</option>
        <option value="Diabetes">Diabetes</option>
        <option value="Hypertension">Hypertension</option>
        <option value="Heart Disease">Heart Disease</option>
        <option value="Asthma">Asthma</option>
        <option value="Thyroid">Thyroid</option>
        <option value="Others">Others</option>
    </select>

    <button type="submit">Calculate BMI</button>
</form>

</body>
</html>
