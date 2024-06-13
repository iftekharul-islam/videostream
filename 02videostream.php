<?php
$videoid=$_POST['videoid'];
?>
<html>
<head><title>:: videostream :: <?=$videoid?>.mp4</title></head>
<body>
<script type='text/javascript'>  
  var elem = document.getElementById('player');
if (elem.requestFullscreen) {
  elem.requestFullscreen();
} else if (elem.mozRequestFullScreen) {
  elem.mozRequestFullScreen();
} else if (elem.webkitRequestFullscreen) {
  elem.webkitRequestFullscreen();
} ;
</script>
<video id="player" width="25%" height="auto" autoplay="autoplay" controls>
  <source src="videodata/<?=$videoid?>.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
</video><br><br><br>

<!-- <a href="videodata/<?$=$videoid?>.mp4">Download link to mp4 file</a><br> -->
</body>
</html>