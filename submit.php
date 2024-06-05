<?php
include 'db.php';

// Check if form fields are set
if (isset ($_POST['age'], $_POST['phone_number'], $_POST['gender'], $_POST['preference'])) {
    // Get form data
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_NUMBER_INT);
    $gender = $_POST['gender'];
    $preference = $_POST['preference'];

    if ($age === false || $age < 18) {
        echo "Age must be a valid number and at least 18 years old.";
        exit;
    }

    if (strlen($phone_number) !== 10 || !ctype_digit($phone_number)) {
        echo "Phone number must be a 10-digit numeric value.";
        exit;
    }

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO user_details1 (age, phone_number, gender, preference) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $age, $phone_number, $gender, $preference);

    // Execute SQL query
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details Form</title>
    <style>
        .container {
            font-family: sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            background-image: url('https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHRyYXZlbHxlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Center the content horizontally */
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
            font-weight: bold;
            /* Make labels bold for better readability */
        }

        input[type="number"],
        input[type="tel"],
        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            /* Increase margin-bottom for better spacing */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            text-align: center;
            background-color: #4CAF50;
            font-size: medium;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            /* Ensure the button behaves as a block element */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Add some styles for the heading */
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
            /* Dark gray text color */
        }

        .button-container {
            text-align: center;
        }

        .button-container input[type="submit"] {
            background-color: #4CAF50;
            font-size: medium;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
    </style>
</head>

<body style="background-color: rgba(173, 216, 230,0.7)">
    <nav>
        <a href="dashboard.html">Home</a>
    </nav>
    <div class="container">
        <h2>User Details Form</h2>
        <form action="submit.php" method="post" onsubmit="return validateForm()">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br><br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone_number" required><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br><br>

            <label for="preference">Preference:</label>
            <input type="text" id="preference" name="preference" required><br><br>

            <div class="button-container">
                <input type="submit" value="Submit">
            </div>
        </form>
        <script>
            function validateForm() {
                var age = document.getElementById("age").value;
                var phone = document.getElementById("phone").value;
                if (age < 18 || age > 100 || age === "" || isNaN(age)) {
                    alert("Age must be a valid number between 18 and 100 years old.");
                    return false;
                }

                if (!/^\d{10}$/.test(phone)) {
                    alert("Phone number must be 10 digits.");
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>

</html>