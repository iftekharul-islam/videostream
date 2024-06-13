<?php
include 'db_connect.php';

$list = array();

$query = "SELECT * FROM video_schedule";
$res = $conn->query($query);
while ($row = $res->fetch_assoc()) {
    $list[] = $row;
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
                var $videoTime = new Date(new Date().toDateString() + ' ' + video.scheduled_time)?.getTime();
                return $videoTime <= curr_time && $videoTime >= prev_time;
            });
            if (scheduledVideos?.length > 0) {
                return scheduledVideos[Math.floor(Math.random() * scheduledVideos?.length)]?.video_name;
            }
            return videos[Math.floor(Math.random() * videos.length)].video_name;
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