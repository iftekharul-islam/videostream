<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Video Schedule</title>
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this video schedule?')) {
                // If confirmed, submit the form
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
</head>
<body>
<h1>Insert Video Schedule</h1>
<form action="insert_video_schedule.php" method="POST">
<!--    <label for="scheduled_date">Scheduled Date:</label>-->
<!--    <input type="date" id="scheduled_date" name="scheduled_date" required><br><br>-->

    <label for="scheduled_time">Scheduled Time:</label>
    <input type="time" id="scheduled_time" name="scheduled_time" required><br><br>

    <label for="video_name">Video Name:</label>
    <select id="video_name" name="video_name" required>
        <?php
        $videoDir = 'videodata/';
        if (is_dir($videoDir)) {
            if ($dh = opendir($videoDir)) {
                while (($file = readdir($dh)) !== false) {
                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                    if (in_array($fileExtension, ['mp4', 'avi', 'mkv'])) { // Add your video file extensions here
                        echo "<option value='$file'>$file</option>";
                    }
                }
                closedir($dh);
            }
        } else {
            echo "<option value=''>No videos found</option>";
        }
        ?>
    </select><br><br>

    <input type="submit" value="Insert">
</form>

<h2>Video Schedule List</h2>
<table border="1">
    <tr>
        <th>Scheduled Time</th>
        <th>Video Name</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    <?php
    include 'db_connect.php';

    // Fetch the schedule data from the database
    $sql = "SELECT * FROM video_schedule ORDER BY scheduled_time ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["scheduled_time"] . "</td>
                    <td>" . $row["video_name"] . "</td>
                    <td>" . $row["created_at"] . "</td>
                    <td>
                        <form id='deleteForm" . $row["id"] . "' action='delete_video_schedule.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <input type='button' value='Delete' onclick='confirmDelete(" . $row["id"] . ")'>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No schedules found</td></tr>";
    }

    $conn->close();
    ?>
</table>
</body>
</html>