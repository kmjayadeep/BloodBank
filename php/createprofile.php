<?PHP
$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];
$bloodgroup = $_REQUEST['bloodgroup'];
$branch = $_REQUEST['branch'];
$dt=0;
if (isset($_REQUEST['date'])) {
	$dt=1;
	$date = $_REQUEST['date'];
}
$year_of_passing = $_REQUEST['year'];
$iyear=intval($year_of_passing);
if($dt)
	$idate=intval($date);
include("db_details.php");
mysql_connect($server, $user_name, $password);
$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json=array();
$json['status']=0;
if ($db_found) {
	$check_exist="SELECT * from $tablename where email='$email' and password='$pass'";
	if (!mysql_num_rows(mysql_query($check_exist))) {
		$json['error']="No user Found, Please Login";
	} else {
		if($dt)
			$SQL=" UPDATE $tablename SET bloodgroup='$bloodgroup', branch='$branch', year='$iyear' ,date='$idate' WHERE email='$email' and password='$pass'";
		else
			$SQL=" UPDATE $tablename SET bloodgroup='$bloodgroup', branch='$branch', year='$iyear' WHERE email='$email' and password='$pass'";
		$result = mysql_query($SQL);
		if ($result) {
			$json['status']=1;
		} else {
			$json['error']=mysql_error();
		}
	}
} else {
        $json['error']="Database not found";
}
echo json_encode($json);
