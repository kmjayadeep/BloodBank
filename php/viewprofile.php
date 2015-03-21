<?PHP
$email = $_REQUEST['email'];
$pass = md5($_REQUEST['password']);
$mode=0;
if (isset($_REQUEST['bloodgroup'])) {
    $bloodgroup=$_REQUEST['bloodgroup'];
    $mode=$mode+1;
}
if (isset($_REQUEST['branch'])) {
    $branch=$_REQUEST['branch'];
    $mode=$mode+2;
}
include "db_details.php";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status']=0;
if ($db_found) {
	if($mode==0)
	    $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE email='$email' and password='$pass' ";
    elseif($mode==1)
	    $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE email='$email' and password='$pass' and  bloodgroup='$bloodgroup'";
    elseif($mode==2)
	    $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE email='$email' and password='$pass' and branch='$branch'";
    elseif($mode==3)
	    $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE email='$email' and password='$pass' and branch='$branch' and bloodgroup='$bloodgroup'";
    $result = mysql_query($SQL) or die($json['error']=mysql_error());
    $num_rows = mysql_num_rows($result);
    if ($num_rows) {
    	$json['status']=1;
        while ($row=mysql_fetch_assoc($result)) {
            $json['donor_info'][]=$row;
        }
    }

} else {
        $json['error']="Database not found";
}
echo json_encode($json);
mysql_close($db_handle);
