<?
require('../assets/v1/connect.php');

$User = new User();

$mail = input_check($_REQUEST['mail']);
$pword = input_check($_REQUEST['pword']);


$user = $User->login($mail, $pword);
	// code...
if ($user == false) {
	// code...
	echo('wrong data');
}else{
	$email = $user['mail'];
echo($email);
}

?>