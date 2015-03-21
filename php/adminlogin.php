<?PHP
$username = $_POST['username'];
$pass = $_POST['password'];
import("db_details.php");
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
$SQL = "SELECT * FROM admin where username = '$username' and password = '$pass'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0) {

$message= "success";

}
else {

$message= "error";

}
print $message;
}
mysql_close($db_handle);


?>