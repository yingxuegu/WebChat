<?php
require_once 'SqlHelper.php';
//header('Location: http://www.kioskea.net/forum/');
$user = $_POST['username'];
$passw = $_POST['passw'];
$passm = $_POST['passm'];
echo "a";
//echo $user.$passw.$passm;

$sql="insert into user (user_name, password) value ('$user', '$passw')";
echo "b";
$sqlHelper = new SqlHelper();
echo "c";
$a = $sqlHelper->excute_dml($sql);
echo "d";
if($a == 1)
{
    echo "Congratulation   ";
    echo "<a href='login.php'>Back to Login Page</a>";
}
else{
    echo "Sorry, fail to create a new account";
}
//file_put_contents("out.txt",$sql."\r\n", FILE_APPEND);

//echo "Congratulation, Your user name is ".$user;
//echo "<br>";
//header('Location: login.php');

?>

