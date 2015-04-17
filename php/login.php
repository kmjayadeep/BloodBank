<?PHP
$email = $_REQUEST['email'];
$pass = md5($_REQUEST['password']);
include "db_details.php";
mysql_connect($server, $user_name, $password);
$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status']=0;
if ($db_found) {
    $check_exist="SELECT * from $tablename where email='$email' and password='$pass'";
    if (!mysql_num_rows(mysql_query($check_exist))) {
                $json['error']="Invalid Credentials";
    } else {
        $json['status']=1;
        $json['email']=$email;
        $json['password']=$pass;
    }
} else {
        $json['error']="Database not found";
}
echo json_encode($json);
