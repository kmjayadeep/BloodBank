<?PHP
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];
import("db_details.php");
mysql_connect($server, $user_name, $password);
$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status']=0;
if ($db_found) {
    $check_duplicate="SELECT * from $tablename where email='$email'";
    if (mysql_num_rows(mysql_query($check_duplicate))) {
		
    }
    $SQL=" INSERT INTO $tablename (name,email,password) VALUES ('$name', $username' , '$pass' )";
    $result = mysql_query($SQL));
    if ($result) {
        $json['status']=1;
        $message= "success";
    }
}

// mysql_close($db_handle);
// print $message;
echo json_encode($json);
}
