<?PHP
$username = $_POST['username'];
$pass = $_POST['password'];
import("db_details.php");
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
	$SQL = "SELECT * FROM blood";
	$result = mysql_query($SQL);
	$json = array();
	$num_rows = mysql_num_rows($result);
	if ($num_rows ) {
		while($row=mysql_fetch_assoc($result)){
			$json['user_info'][]=$row;
		}
	}

}
echo json_encode($json); 
mysql_close($db_handle);


?>