<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to sanitize user input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["signup"])) {
    $username = test_input($_POST["signup-username"]);
    $email = test_input($_POST["signup-email"]);
    $password = test_input($_POST["signup-password"]);

    // Register user in the database using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO travel1 (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css"> <!-- Assuming styles.css contains your signup form styles -->
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <div class="box-form">
        <div class="left">


            <img src="pik/Travel-agency-logo-design-template-on-transparent-background-PNG.png" class="logo"
                width="70px">
            <div class="overlay">
                <h1>SAFARI</h1>
                <p>Where will your next adventure take you? Find out with us.</p>
                <span>
                    <p>Join us today!</p>
                </span>
            </div>
        </div>


        <div class="right">
            <h5>Signup</h5>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <p>Already have an account? <a href="login.php">Login here</a></p>
                <div class="inputs">
                    <input type="text" name="signup-username" placeholder="Username">
                    <br>
                    <input type="email" name="signup-email" placeholder="Email">
                    <br>
                    <input type="password" name="signup-password" placeholder="Password">
                </div>
                <br><br>
                <button type="submit" name="signup">Signup</button>
            </form>

        </div>
</body>

</html>