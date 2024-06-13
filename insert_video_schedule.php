<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $scheduled_time = $_POST['scheduled_time'];
    $video_name = $_POST['video_name'];

    // Insert the data into the database
    $sql = "INSERT INTO video_schedule (scheduled_time, video_name) VALUES ('$scheduled_time', '$video_name')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the form page
        echo 'Video schedule inserted successfully.....';
        header("Location: video_schedule.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>