<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

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