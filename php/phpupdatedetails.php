<?PHP
$name =  $_POST['name'];
$clas =  $_POST['clas'];
$batchfrom =  $_POST['batchfrom'];
$batchto =  $_POST['batchto'];
$bg =  $_POST['bg'];
$mob =  $_POST['mob'];
$address =  $_POST['address'];
$lastdon =  $_POST['lastdon'];
$oldname =  $_POST['oldname'];
$oldclass =  $_POST['oldclass'];
$oldbatch =  $_POST['oldbatch'];
$user_name = "a7636106_kazmik";
$password = "kimzak123";
$database = "a7636106_bbdb";
$server = "mysql6.000webhost.com";
mysql_connect($server, $user_name, $password);

$db_handle = mysql_connect($server, $user_name, $password);

$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {

$SQL=" UPDATE details SET name = '$name' , class = '$clas' , batchfrom='$batchfrom' , batchto='$batchto' , bg = '$bg' , mob='$mob' , address = '$address' , lastdon = '$lastdon' WHERE name = '$oldname' AND class = '$oldclass' AND batchfrom = '$oldbatch' ";
$result = mysql_query($SQL);

mysql_close($db_handle);
print 'success';
}


?>