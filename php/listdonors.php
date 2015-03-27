<?PHP
$mode=0;
if (isset($_REQUEST['bloodgroup'])) {
    $bloodgroup=$_REQUEST['bloodgroup'];
    $mode=$mode+1;
}
if (isset($_REQUEST['branch'])) {
    $branch=$_REQUEST['branch'];
    $mode=$mode+2;
}

//this is temporary code, to incorporate all option in bloodgroup and branch
$newmode=0;
if($mode==1 || $mode==3)
    if(!($bloodgroup=="All"))
        $newmode=$newmode+1;
if ($mode==2 || $mode==3)
    if(!($branch=="All"))
        $newmode=$newmode+2;
$mode=$newmode;
include "db_details.php";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);
$json = array();
$json['status']=0;
if ($db_found) {
    if($mode==0)
        $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE 1";
    elseif($mode==1)
        $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE bloodgroup LIKE '$bloodgroup'";
    elseif($mode==2)
        $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE branch LIKE '$branch'";
    elseif($mode==3)
        $SQL = "SELECT name,email,bloodgroup,branch,mobile,year FROM $tablename WHERE branch LIKE '$branch' and bloodgroup LIKE '$bloodgroup'";
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
