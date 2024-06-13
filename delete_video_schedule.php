<?php
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID of the schedule to be deleted
    $id = $_POST['id'];

    // Delete the record from the database
    $sql = "DELETE FROM video_schedule WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the form page
        echo 'Video schedule deleted successfully.....';
        header("Location: video_schedule.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>