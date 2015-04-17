<?PHP
$mode = 0;
$length = 50; // MAX Results
$year=0;
if (isset($_REQUEST['bloodgroup'])) {
	$bloodgroup = $_REQUEST['bloodgroup'];
	if (!($bloodgroup == "All")){ 
		$mode = $mode + 1;
	}
}
if (isset($_REQUEST['branch'])) {
	$branch = $_REQUEST['branch'];
	if (!($branch == "All")) {
		$mode = $mode + 2;
	}
}


if (isset($_REQUEST['year'])) {
	$getyear = $_REQUEST['year'];
	if($getyear!='All')
		$mode = $mode + 4;
}

//this is temporary code, to incorporate all option in bloodgroup and branch
$newmode = $mode;
// if ($mode == 1 || $mode == 3||$mode==5||$mode==7) {
// 	if (!($bloodgroup == "All")) {
// 		$newmode = $newmode + 1;
// 	}
// }

// if ($mode == 2 || $mode == 3||$mode==6||$mode==7) {
// 	if (!($branch == "All")) {
// 		$newmode = $newmode + 2;
// 	}
// }

// if($mode>=4){
// 	$newmode=newmode+4;
// }

$mode = $newmode;
include "db_details.php";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status'] = 0;
if ($db_found) {
	$cur_year=date("Y");
	$cur_mon=date("m");
	$year=$cur_year-$getyear;
	if($cur_mon>6)
		$year=$year+1;

	if ($mode == 0) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE bloodgroup is not null";
	} elseif ($mode == 1) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE bloodgroup LIKE '$bloodgroup%'";
	} elseif ($mode == 2) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE branch LIKE '%$branch%'";
	} elseif ($mode == 3) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE branch LIKE '%$branch%' and bloodgroup LIKE '$bloodgroup%'";
	} elseif ($mode == 4) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE year='$year' and bloodgroup is not null";
	} elseif ($mode == 5) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE year='$year' and bloodgroup LIKE '$bloodgroup%'";
	} elseif ($mode == 6) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE year='$year' and branch LIKE '%$branch%'";
	} elseif ($mode == 7) {
		$SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE year='$year' and branch LIKE '%$branch%' and bloodgroup LIKE '$bloodgroup%'";
	} 

	$result = mysql_query($SQL) or die($json['error'] = mysql_error());
	$num_rows = mysql_num_rows($result);
	if ($num_rows) {
		$json['status'] = 1;
		while ($row = mysql_fetch_assoc($result)) {
			$json['donor_info'][] = $row;
		}
	}

} else {
	$json['error'] = "Database not found";
}
shuffle($json['donor_info']);
$json['donor_info'] = array_slice($json['donor_info'], 0, $length);
shuffle($json['donor_info']);
echo json_encode($json);
mysql_close($db_handle);
