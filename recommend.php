<!-- recommend.php -->
<?php
include 'db.php';

// Retrieve user input
$budgetRange = $_POST['budget'];
$preference = $_POST['preference'];

// Extract lower and upper bounds of budget range
list($minBudget, $maxBudget) = explode('-', $budgetRange);
// Debugging output
$q = "$minBudget-$maxBudget";

$sql = "SELECT * FROM packages1 WHERE budget ='$q' AND preference = '$preference'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<body style='background-color: rgba(0, 0, 0, 0.1)'><div class='package' style='
        background-color: rgba(173, 216, 230,0.7);
        border: 1px solid #ccc; 
        border-radius: 8px; 
        padding: 20px; 
        margin: 0 auto 20px; 
        width: 80%; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
        <div class='package-details' style='
            font-family: Arial, sans-serif; 
            color: #333;'>
            <p style='font-size: 18px; text-decoration: underline;'><strong>Package details</strong></p>
            <p><strong>Location:</strong> " . $row["location"] . "</p>
            <p><strong>Price:</strong> " . $row["price"] . "</p>
            <p><strong>Preference:</strong> " . $row["preference"] . "</p>
            <p><strong>Description:</strong> " . $row["description"] . "</p>
            <p><strong>Type:</strong> " . $row["type"] . "</p>
            <p><strong>Features:</strong> " . $row["features"] . "</p>
            <p><strong>Duration:</strong> " . $row["duration"] . "</p>
            <p><strong>Best Time:</strong> " . $row["best time"] . "</p>
            <div style='text-align: center;'>
                <img src='" . $row["image_url"] . "' alt='Package Image' style='
                    width: 100%; 
                    height: 300px; 
                    margin-top: 10px;
                    border-radius: 2px;
                    object-fit: cover;'>
            </div>
        </div>
    </div>
    </body>";




    }
} else {
    echo "No packages found matching your criteria.";
}
$conn->close();
?>