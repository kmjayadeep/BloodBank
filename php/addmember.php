<?PHP
$name = $_POST['name'];
$clas = $_POST['clas'];
$bg = $_POST['bg'];
$mob = $_POST['mob'];
$hostel = $_POST['hostel'];
$year = $_POST['year'];
$date = $_POST['date'];
$iyear=intval($year);
$idate=intval($date);
import("db_details.php");
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

$SQL=" INSERT INTO blood (name,branch,bloodgroup,mobile,hostel,year,date) VALUES ('$name' , '$clas' ,'$bg' ,'$mob' ,'$hostel' ,'$iyear' ,'$idate' )";
$result = mysql_query($SQL);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "";
} else {
    $message= "success";
}
mysql_close($db_handle);
print $message;
}
