<?php
include 'db.php';
echo "<html>";
echo "<h3> Do you want to delete the checkins data base ?<br>";
echo "If  yes  proceed by clicking on delete button below:</h3>";
echo "You typially want to start with a clean slate.<br> That way you 
can keep up with the checkins for this session.<br> There is a date stamp
to keep them in order. ";
echo "<br>
<li><a href=\"http://98.196.250.3/ncslogger\">MainSite</a> </li>
<li><a href=\"man.html\">Instructions</a> </li>
<li><a href=\"listcheckins.php\">View Checkins</a> </li>
<li><a href=\"viewmaster.php\">View Master List</a> </li> ";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
$sql = "TRUNCATE `ncslogger`.`checkindb`";
if(isset($_POST['formflg'])) {
  echo "Checkins Database Cleaned ";
  $result = $conn->query($sql);
}	
echo "\n<form name=\"formdel\" method=\"post\" action=\"".htmlentities($_SERVER['PHP_SELF'])."\">\n" ;
echo "<input type=\"submit\"  style=\"background-color:red;color:white;width:150px;height:40px;\" value=\"Delete Checkins\">\n";
echo "<input type=\"hidden\" NAME=\"formflg\" SIZE=\"10\">\n";
?>

