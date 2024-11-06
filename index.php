<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Diet Planner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        header {
            background: #4CAF50; /* Green background */
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav a {
            margin: 10px;
            color: white;
            text-decoration: none;
        }
        .intro {
            text-align: center;
            margin: 20px;
        }
        .images {
            display: flex;
            justify-content: center;
        }
        .image-container img {
            width: 30%; /* Adjust based on your preference */
            margin: 10px;
            border-radius: 8px; /* Rounded corners */
        }
        .footer {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Your Personal Diet Planner</h1>
        <p>Your journey to a healthier lifestyle starts here!</p>
        <nav>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <main>
        <section class="intro">
            <h2>Why Choose Us?</h2>
            <p>We provide personalized diet plans tailored to your body type and health goals.</p>
            <p>Calculate your BMI and receive customized meal suggestions!</p>
        </section>

        <section class="images">
            <div class="image-container">
                <img src="images/healthy_meal1.jpg" alt="Healthy Meal 1">
                <img src="images/healthy_meal2.jpg" alt="Healthy Meal 2">
                <img src="images/healthy_meal3.jpg" alt="Healthy Meal 3">
            </div>
        </section>

        <section class="footer">
            <p>&copy; 2024 Diet Planner. All Rights Reserved.</p>
        </section>
    </main>
</body>
</html>