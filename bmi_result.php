<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Calculate BMI
    $bmi = $weight / (($height / 100) * ($height / 100));

    // Determine health status and meal plan suggestions
    if ($bmi < 18.5) {
        $status = "Underweight";
        $meal_plan = [
            "Breakfast: Poha with peanuts",
            "Lunch: Dal with brown rice and salad",
            "Dinner: Paneer butter masala with chapati"
        ];
        $tips = "Include high-calorie foods like nuts and dairy products in your meals.";
        
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        $status = "Healthy";
        $meal_plan = [
            "Breakfast: Oats upma",
            "Lunch: Quinoa salad with mixed vegetables",
            "Dinner: Grilled chicken with steamed vegetables"
        ];
        $tips = "Maintain a balanced diet with a mix of carbohydrates, proteins, and fats.";
        
    } else {
        $status = "Overweight";
        $meal_plan = [
            "Breakfast: Vegetable poha",
            "Lunch: Roti with mixed vegetable curry",
            "Dinner: Lentil soup with a side of salad"
        ];
        $tips = "Focus on portion control and include more fruits and vegetables in your diet.";
    }

    // Update user data in the database (optional)
    $userId = $_SESSION['user_id'];
    $sql = "UPDATE users SET height='$height', weight='$weight', bmi='$bmi', status='$status' WHERE id='$userId'";
    if ($conn->query($sql) !== TRUE) {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header("Location: bmi_input.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>BMI Result</title>
   <style>
       body { 
           font-family: Arial, sans-serif; 
           margin: 0; 
           background-color: #f4f4f4; 
       }  
       .result-container { 
           width: 500px; /* Increased width for better aesthetics */
           margin: auto; 
           padding: 40px; /* Increased padding for a spacious look */
           background-color: white; 
           border-radius: 10px; 
           box-shadow: 0 4px 20px rgba(0,0,0,0.1); /* Softer shadow */
           margin-top: 50px; /* Space from the top */
           text-align: center; /* Center align text for better readability */
       }  
       h2 { 
           color: #4CAF50; /* Green color for headings */ 
           margin-bottom: 20px; /* Space below heading */
           font-size: 2rem; /* Larger font size */
       }  
       h3 { 
           color: #333; 
           margin: 15px 0; /* Space around h3 */
       }  
       h4 { 
           color: #555; 
           margin: 10px 0; /* Space around h4 */
       }  
       .meal-plan li { 
           list-style-type:none; 
           padding: 10px; 
           background-color: #e7f3fe; /* Light blue background */ 
           border-left: 5px solid #2196F3; /* Blue left border */ 
           margin-bottom: 10px; /* Space between meal items */ 
           border-radius: 4px; /* Rounded corners */ 
       }  
       p { 
           background-color: #e8f5e9; /* Light green background for tips */ 
           padding: 15px; 
           border-radius: 4px; 
           color: #333; 
           margin: 15px 0; /* Space around the tips paragraph */
       }  
       .logout { 
           position: absolute; 
           top: 20px; 
           right: 20px;
           font-size: 1rem; /* Adjust font size for logout link */
       }
       a { 
           display: block; 
           text-align: center; 
           margin-top: 20px; 
           color: #2196F3; /* Blue color for links */
           text-decoration: none; /* Remove underline */
       }
       a:hover {
           text-decoration: underline; /* Underline on hover */
       }
   </style>  
</head>  
<body>

<div class='logout'><a href='logout.php'>Logout</a></div>

<div class='result-container'>
   <h2>Your BMI Result</h2>
   <h3>Your BMI is: <?php echo round($bmi, 2); ?></h3>
   <h4>Status: <?php echo htmlspecialchars($status); ?></h4>
   <h4>Suggested Meal Plan:</h4>
   <ul class='meal-plan'>
       <?php foreach ($meal_plan as $meal): ?>
           <li><?php echo htmlspecialchars($meal); ?></li> <!-- Use htmlspecialchars for safety -->
       <?php endforeach; ?>
   </ul>

   <h4>Tips to Maintain a Healthy Body:</h4>
   <p><?php echo htmlspecialchars($tips); ?></p>
</div>

</body>
</html>
