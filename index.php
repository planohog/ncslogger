<?php
//
include 'look.php' ;
include 'db.php' ;
$bodycolor = "white";
$headcolor = "white";
$headercontent = "<center><h2>NCS Database</h2></center>";
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
function text_log($input {
$logfile = fopen("/tmp/checkin-logs.txt", "a") or die("Unable to open file!");
//$txt = "user id date";
fwrite($logfile, "\n". $input);
fclose($logfile);
}
		  



echo "<title>NCSLogger Call Sign Database</title>\n";
echo "<body bgcolor=$bodycolor>\n";
echo "<table border=1  cellpadding=10>\n ";
echo "<tr>\n<td  WIDTH=\"%100\" bgcolor=$headcolor colspan=2 >\n";
echo "$headercontent\n";
echo "</td></tr>\n";
echo "<tr>\n<td bgcolor=$leftcolor width=\"%30\" valign=top>\n";
echo "$leftcontent\n";
echo "</td>\n";
echo"<td bgcolor=$maincolor width=\"%70\">\n";
echo "<FORM METHOD=\"POST\" ACTION=$PHP_SELF >\n";
$tmpx = count($_POST['checkin']) ;
        if( isset($_POST['checkin']) && count($_POST['checkin']) >  0 ) {

           $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);	
            foreach($_POST['ticked'] as $callsignvalue){
		   $sql = "SELECT * FROM `checkinmain` WHERE `callsign` = '$callsignvalue' ORDER BY `ndx` ASC "; 
		   $result = $conn->query($sql);
                   if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {   // value="' . $row['usn'] . '"
			     $chkincall = $row['callsign'];
			     $chkinname = $row['name'];
                             $chkintown   = $row['town'];
                             $chkinst   = $row['state'];
                             $chkincounty   = $row['county'];
                             $chkingrid  = $row['grid'];
                             $chkinnet  = $row['net'];
                             $chkinsel  = 0;
			     $chkinlast = 'CURRENT_TIME()';
			     $sql2 = "SELECT * FROM `checkindb` WHERE `callsign` = '".$chkincall."' ORDER BY `ndx` ASC ";
			     $res2 = $conn->query($sql2);
			     if ($res2->num_rows == 0) {
			       $sqlupdatetime = "UPDATE `checkinmain` SET `lastheard` = CURRENT_TIME() WHERE `checkinmain`.`callsign` = '$chkincall' ";
                             // echo "SQLTIME ". $sqlupdatetime ."   ";
			       $res2 = $conn->query($sqlupdatetime);
			      // echo "NUM=".$conn->affected_rows ." "; 
                               $sql3 = "INSERT INTO checkindb (callsign,state,town,name,county,grid,net,selected,lastheard) VALUES ('".$chkincall."','".$chkinst."','".$chkintown."','".$chkinname."','".$chkincounty."','".$chkingrid."','".$chkinnet."','".$chkinsel."',CURRENT_TIME() )" ;
			       $res3 = $conn->query($sql3);
			       if ($conn->affected_rows > 0 ) {
			         echo "<font color=GREEN><h3>Checkin Inserted ".$chkincall."</font></h3> \n";
                               } else { 
				 echo "<font color=RED<h3>>Checkin insert FAILED ".$chkincall."</font></h3> \n";
			       } // affectedrows
			      } else { 
                                echo "<font color=YELLOW><h3>Dupliate Checkin Dectected ".$chkincall ."</font></h3>\n";
			      } // res2 rows
                    } // end whilefetch
             $conn->close(); 
		   } // end if rows
            } // end foreach ticked
	}  // isset end checkins
if(isset( $_POST['submit'] )) {
	$thecall = $_POST['callsign'] ;
	$thecall = proc_input($thecall);
        if ( $thecall  == "" )   {
	   echo "<font color=RED><h3>You Must enter string to search";
           echo "</h3></font><br>";
	}
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);	
	$sql = "SELECT * FROM `checkinmain` WHERE `callsign` LIKE '%$thecall%' ORDER BY `ndx` ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {   // value="' . $row['usn'] . '"
		echo "<tr>";
                // echo "<td><input type=\"checkbox\" name=\"ticked[]\" value=\"".$row['callsign']."\"</td><td>". $row["callsign"]. " " . $row["name"]. "  " . $row["town"]. ",".$row["state"]."</td>\n";
                echo "<td><input type=\"checkbox\" name=\"ticked[]\" value=\"".$row['callsign']."\"</td><td>". $row["callsign"]. "</td><td> " . $row["name"]. " </td><td> " . $row["town"]. "</td><td>".$row["state"]."</td></td>\n";
		echo "</tr>";
                }
             } else {
             echo "0 results";
             }
             $conn->close(); 
} else {      // isset formflg submit
    	// end do work   
} 

//****** FIRST TIME IN THIS PAGE
//****** this is the main form 
echo"<h1>NSCNetLogger </h1> \n";
echo "Search<br>\n";
echo "<INPUT TYPE=\"text\" NAME=\"callsign\" SIZE=\"40\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"formflg\" SIZE=\"10\">\n";
echo "</ul><br>\n";
echo "<INPUT TYPE=\"submit\" name=\"submit\" style=\"background-color:Green;color:white;\"  value=\"Search Call\">\n";
echo "<input type=\"submit\" name=\"checkin\" style=\"background-color:Green;color:white;\" value=\"Log Checkin\">\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
   
?>
