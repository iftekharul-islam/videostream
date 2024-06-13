<?php

$DB_host = 'localhost';
$DB_user = 'dev110';
$DB_password = 'gr638';
$DB_name = 'dev110';

$conn = new mysqli($DB_host, $DB_user, $DB_password, $DB_name);

/*
$link = mysql_connect ($DB_host, $DB_user, $DB_password);
if (!link) {
  die ('Connection failed.' . mysql_error ());
}

$db_selected = mysql_select_db ($DB_name, $link);
if (!link) {
  die ('DB selection failed.' . mysql_error ());
}
*/

$migrationsTableQuery = "SELECT id, migration, batch FROM migrations";
$migrationsTableResult = $conn->query($migrationsTableQuery);

echo "<table border=1>\n";
echo "<tr>\n";
echo "<th>id<th>migration<th>batch\n";

while ($row = $migrationsTableResult->fetch_assoc()) {
  echo "<tr>\n";
  echo "<td>" . $row['id'] . "\n";
  echo "<td>" . $row['migration'] . "\n";
  echo "<td>" . $row['batch'] . "\n";
}

echo "</table>\n";
?>
