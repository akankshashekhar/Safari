<?php

include 'db.php';

// Function to sanitize user input
function test_input($data)
{
    global $conn; // Make sure $conn is available inside the function
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["login"])) {
    $username_or_email = test_input($_POST["login-username-email"]);
    $password = test_input($_POST["login-password"]);

    // Check user credentials
    $sql = "SELECT * FROM travel1 WHERE (username='$username_or_email' OR email='$username_or_email')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();

        if (password_verify($password, $userDetails['password'])) {
            // Start the session
            session_start();
            header("Location: dashboard.html");
            exit();
        } else {
            echo "Login failed. Invalid password.";
        }
    } else {
        echo "Login failed. Invalid username/email.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <nav>
        <a href="index.php">Home</a>
    </nav>

    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="styleforlogin.css">
</head>

<body>
    <div class="box-form">
        <div class="left">
            <img src="pik/Travel-agency-logo-design-template-on-transparent-background-PNG.png" class="logo"
                width="70px">
            <div class="overlay">
                <h1>SAFARI</h1>
                <p>Where will your next adventure take you? Find out with us.</p>
                <span>
                    <p>login with social media</p>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
                </span>
            </div>
        </div>


        <div class="right">
            <h5>Login</h5>
            <form method="post" action="dashboard.html"> <!-- Change the action to match your second code -->
                <p>Don't have an account? <a href="signup.php">Create Your Account</a> it takes less than a minute</p>
                <div class="inputs">
                    <input type="text" name="login-username-email" placeholder="Username or Email">
                    <!-- Change the name attribute to match your second code -->
                    <br>
                    <input type="password" name="login-password" placeholder="Password">
                    <!-- Change the name attribute to match your second code -->
                </div>

                <br><br>

                <div class="remember-me--forget-password">
                    <label>
                        <input type="checkbox" name="remember" checked>
                        <span class="text-checkbox">Remember me</span>
                    </label>
                    <p>forgot password?</p>
                </div>

                <br>
                <button type="submit">Login</button>
        </div>

    </div>
</body>

</html>