<?php

include 'db.php';
// echo "<html><body><table border=1 cellspacing=1 cellpadding=2><tr align=\"center\"> ";
// echo "<h2>Checkin Query result:</h2> ";a
echo "<title>NCS Call Sign Master List Database</title>\n";
echo "<body bgcolor=$bodycolor>\n";
echo "<br>
<li><a href=\"http://192.168.10.10/ncslogger\">MainSite</a> </li>
<li><a href=\"man.html\">Instructions</a> </li>
<li><a href=\"listcheckins.php\">View Checkins</a> </li>
<li><a href=\"viewmaster.php\">View Master List</a> </li> ";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
$sql = "SELECT * FROM `checkinmain` WHERE 1 ORDER BY `ndx` ASC LIMIT 300 ";
$result = $conn->query($sql);
#echo "Number of CallSigns ". $result->num_rows ."\n";
echo "<table border=1  cellpadding=10>\n ";
// callsign,state,town,name,county,grid,net,selected,lastheard
  if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {   // value="' . $row['usn'] . '"
	echo "<tr>";
        echo "<td>".$row["callsign"]."</td><td>".$row["name"]."</td><td>".$row["town"]."</td><td>".$row["state"]."</td><td>".$row['county']."</td><td>".$row['grid']."</td><td>".$row['net']."</td><td>".$row['lastheard']."</td>\n";
	echo "</tr>\n";
      }
  }
$conn->close();
?>
