<?php
include 'db_connect.php';

$list = array();

$query = "SELECT * FROM video_schedule";
$res = $conn->query($query);
while ($row = $res->fetch_assoc()) {
    $list[] = $row;
}

$videoList = array();
$videoDir = 'videodata/';
if (is_dir($videoDir)) {
    if ($dh = opendir($videoDir)) {
        while (($file = readdir($dh)) !== false) {
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array($fileExtension, ['mp4', 'avi', 'mkv'])) { // Add your video file extensions here
                $videoList[] = $file;
            }
        }
        closedir($dh);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
</head>

<body>
    <video id="videoPlayer" width="640" height="480" controls autoplay>
        <source id="videoSource" src="videodata/04.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <br /><br />

    <a href="video_schedule.php">
        <input type="button" value="Video Schedule List">
    </a>

    <script>
        const videosDir = 'videodata/';
        const videoPlayer = document.getElementById('videoPlayer');
        const videoSource = document.getElementById('videoSource');

        function getRandomVideo() {
            var videos = <?php echo json_encode($list); ?>;
            var video = document.getElementById('videoPlayer');
            var duration = video?.duration;
            var curr_time = new Date()?.getTime();
            var prev_time = new Date(curr_time - duration * 1000)?.getTime();

            var scheduledVideos = videos?.filter(video => {
                var videoTime = new Date(new Date().toDateString() + ' ' + video.scheduled_time)?.getTime();
                return videoTime <= curr_time && videoTime >= prev_time;
            });
            var final_videos = "";
            if (scheduledVideos?.length > 0) {
                final_videos = scheduledVideos[Math.floor(Math.random() * scheduledVideos?.length)]?.video_name;
                console.log("Scheduled Video: ", final_videos);
            } else {
                var videoList = <?php echo json_encode($videoList); ?>;
                final_videos = videoList[Math.floor(Math.random() * videoList.length)];
                console.log("Random Video: ", final_videos);
            }
            return final_videos
        }

        function playRandomVideo() {
            videoSource.src = videosDir + getRandomVideo();
            videoPlayer.load();
            videoPlayer.play();
        }

        videoPlayer.addEventListener('ended', function() {
            playRandomVideo();
        });
    </script>
</body>

</html>