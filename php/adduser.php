<?PHP
$username = $_POST['username'];
$pass = $_POST['password'];
import("db_details.php");
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

$SQL=" INSERT INTO user (username,password) VALUES ('$username' , '$pass' )";
$result = mysql_query($SQL);
if (!$result){
	$message  = 'Invalid query: ' . mysql_error() . "";
}
else{
	$message= "success";
}
mysql_close($db_handle);
print $message;
}


?>