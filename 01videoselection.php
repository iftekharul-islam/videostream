<html>
<head><title>:: VideoStream :: file selection</title></head>
<body>
Please select a video to be displaied:<br>
<form action=02videostream.php method=post>
<select name=videoid>
<?php
  for ($i=1; $i<=9; $i++)
    echo "<option value=0$i>0$i</option>\n";
?>
</select><br>
<input type=submit>
</form>
</body>

</html>