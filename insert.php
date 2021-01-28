<?php

//
include 'look.php' ;
include 'db.php' ;

//echo "<html><script src=\"https://code.jquery.com/jquery-3.5.0.js\"></script>";
$bodycolor = "white";
$headcolor = "white";
$headercontent = "<center><h2>NCS Database</h2></center>
";
$leftcolor = "white";
$maincolor = "white";
//#########################################################
function proc_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = preg_replace("/\s+/", "", $input);
    return $input;
}
//#########################################################
echo "<title>NCSLogger Call Sign Database Input</title>\n";
echo "<body bgcolor=$bodycolor>\n";
echo "<table border=1  cellpadding=10>\n ";
echo "<tr>\n<td  WIDTH=\"%100\" bgcolor=$headcolor colspan=2 >\n";
echo "$headercontent\n";
echo "</td></tr>\n";
echo "<tr>\n<td bgcolor=$leftcolor width=\"%30\" valign=top>\n";
echo "$leftcontent\n";
echo "</td>\n";
echo "<td bgcolor=$maincolor width=\"%70\">\n";

echo "<FORM METHOD=\"POST\" ACTION=$PHP_SELF >\n";


?>


<div class="form-group">
 <label>Enter Call Sign</label>
 <input type="text" name="callsign" id="callsign" class="form-control" />
</div>
<div class="form-group">
 <label>Enter Last,First</label>
 <input type="text" name="name" id="name" class="form-control" />
</div>
<div class="form-group">
 <label>Enter Town</label>
 <input type="text" name="town" id="town" class="form-control" />
</div>
<div class="form-group">
 <label>Enter State</label>
 <input type="text" name="state" id="state" class="form-control" />
</div>
<div class="form-group">
 <label>Enter county</label>
 <input type="text" name="county" id="county" class="form-control" />
 </div>
<div class="form-group">
 <label>Enter grid</label>
 <input type="text" name="grid" id="grid" class="form-control" />
 </div>
<div class="form-group">
 <label>Enter NET</label>
 <input type="text" name="net" id="net" class="form-control" />
 </div>

<?php
echo "<INPUT TYPE=\"submit\" name=\"submit\" style=\"background-color:Green;color:white;\"  value=\"Store Call Sign\">\n";
if(isset( $_POST['submit'] )) {
        $thecall = proc_input($_POST['callsign']) ;
        $thename = proc_input($_POST['name']) ;
        $thetown = proc_input($_POST['town']) ;
        $thestate = proc_input($_POST['state']) ;
        $thecounty = proc_input($_POST['county']) ;
        $thegrid = proc_input($_POST['grid']) ;
        $thenet = proc_input($_POST['net']) ;
        $thecall = strtoupper($thecall);
//  echo "THECALL=".$thecall."\n";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 $sqldup = "SELECT * FROM `checkinmain` WHERE `callsign` = '$callsign' ";
 $sqlin = "INSERT INTO checkinmain (callsign,state,town,name,grid,net,lastheard) VALUES ('".$thecall."','".$thestate."','".$thetown."','".$thename."','".$thegrid."','".$thenet."',CURRENT_TIME() )";
 $resdup = $conn->query($sqldup);
 if ($resdup->num_rows == 0) {
    $resin = $conn->query($sqlin);
     if ($conn->affected_rows > 0 ) {
        echo "<font color=GREEN><h3>Checkin Inserted ".$thecall."</font></h3> \n";
        } else {
        echo "<font color=RED<h3>>Checkin insert FAILED ".$thecall."</font></h3> \n";
     } // affectedrows





  } // end if resdup=0 
}
?>






