<?PHP
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$pass = md5($_REQUEST['password']);
$mobile = $_REQUEST['mobile'];
include "db_details.php";
mysql_connect($server, $user_name, $password);
$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status']=0;
$error="placeholder";
if ($db_found) {
    $check_duplicate="SELECT * from $tablename where email='$email' or mobile='$mobile'";
    if (!mysql_num_rows(mysql_query($check_duplicate))) {
        $SQL=" INSERT INTO $tablename (name,email,password,mobile) VALUES ('$name', '$email', '$pass','$mobile' )";
        $result = mysql_query($SQL);
        if ($result) {
            $json['status']=1;
            $message= "success";
        } else {
            $error=mysql_error();
            if ((strpos($error, "SQL syntax")))
                $json['error']="Syntax Error";
            else
                $json['error']=$error;
        }
    } else {
        $query="SELECT id from $tablename where email='$email'";
        if (mysql_num_rows(mysql_query($query)))
            $json['error']="Duplicate Entry for Email";
        else
            $json['error']="Duplicate Entry for Mobile";
        // $json['error']=$error;
    }
} else {
        $json['error']="Database not found";
}
echo json_encode($json);
