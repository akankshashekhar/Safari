<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert into database
    $sql = "INSERT INTO contact_messages1 (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Thank you for contacting us!";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "dashboard.html";
                }, 3000); // 3000 milliseconds = 3 seconds
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>